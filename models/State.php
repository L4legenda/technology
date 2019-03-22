<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "state".
 *
 * @property int $id
 * @property string $title
 * @property string $anons
 * @property string $text
 * @property string $status
 * @property string $date
 * @property int $author
 */
class State extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['anons', 'text'], 'string'],
            [['date'], 'safe'],
            [['author'], 'integer'],
            [['title', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'anons' => 'Anons',
            'text' => 'Text',
            'status' => 'Status',
            'date' => 'Date',
            'author' => 'Author',
        ];
    }

}
