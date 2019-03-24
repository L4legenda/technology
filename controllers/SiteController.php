<?php

namespace app\controllers;

use app\models\Comment;
use app\models\CommentForm;
use app\models\SinginForm;
use app\models\State;
use app\models\StateForm;
use app\models\Users;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        if($delState = Yii::$app->request->post("deleteState")){
            $st = State::findOne($delState);
            $st->status = "2";
            $st->save();
        }
        if($restState = Yii::$app->request->post("restoreState")){
            $st = State::findOne($restState);
            $st->status = "1";
            $st->save();
        }
        if($pubState = Yii::$app->request->post("publicState")){
            $st = State::findOne($pubState);
            $st->status = "0";
            $st->save();
        }
        if($draftState = Yii::$app->request->post("draftState")){
            $st = State::findOne($draftState);
            $st->status = "1";
            $st->save();
        }

        $query = State::find();
        if(Yii::$app->user->getIdentity()->privilege != "admin"){
            $query->where(["status"=>"0"]);
        }
        if($sort = Yii::$app->request->post("sort")){

            $query->orderBy($sort);

        }
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        $state = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', compact("state", "pages"));
    }
    public function actionState($id){
        $state = State::findOne($id);

        $model = new CommentForm();
        $coment = new Comment();

        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $coment->name = $model->name;
                $coment->text = $model->text;
                $coment->post = $id;
                $coment->date = date("Y-m-d");
                $coment->save();
            }
        }
        $comments = Comment::find()->where(["post"=>$id])->all();
        return $this->render("state", compact("state", "model", "comments"));
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionMystate(){

        if($delState = Yii::$app->request->post("deleteState")){
            $st = State::findOne($delState);
            $st->status = "2";
            $st->save();
        }
        if($restState = Yii::$app->request->post("restoreState")){
            $st = State::findOne($restState);
            $st->status = "1";
            $st->save();
        }
        if($pubState = Yii::$app->request->post("publicState")){
            $st = State::findOne($pubState);
            $st->status = "0";
            $st->save();
        }
        if($draftState = Yii::$app->request->post("draftState")){
            $st = State::findOne($draftState);
            $st->status = "1";
            $st->save();
        }

        $query = State::find()->where(["author"=>Yii::$app->user->getId()]);

        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3]);
        $state = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render("mystate", compact("state", "pages"));
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    public function actionEditstate($id){
        $model = new StateForm();
        $state = State::findOne($id);
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $state->title = $model->title;
                $state->anons = $model->anons;
                $state->text = $model->text;
                $state->status = $model->status;
                $state->save();
            }
        }

        return $this->render("editstate", compact("model", "state"));
    }
    public function actionSingin(){

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new SinginForm();
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $user = new Users();
                $user->login = $model->login;
                $user->password = md5($model->password);
                $user->privilege = "user";
                $user->save();
                Yii::$app->user->login($user);
                $this->goHome();
            }

        }
        return $this->render("singin", compact("model"));
    }

    public function actionNewstate(){
        $model = new StateForm();
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                $state = new State();
                $state->title = $model->title;
                $state->anons = $model->anons;
                $state->text = $model->text;
                $state->status = $model->status;
                $state->date = date("Y-m-d");
                $state->author = Yii::$app->user->getId();
                $state->save();
            }
        }
        return $this->render("newstate", compact("model"));
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
