<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "expense_formula_master".
 *
 * @property int $category_id
 * @property int $expense_category
 * @property string $expense_per
 *
 * @property CategoryMaster $category
 * @property ExpsenseCategory $expenseCategory
 */
class ExpenseFormulaMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense_formula_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'expense_category'], 'required'],
            [['category_id', 'expense_category'], 'integer'],
            [['expense_per'], 'number'],
            [['category_id', 'expense_category'], 'unique', 'targetAttribute' => ['category_id', 'expense_category']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryMaster::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['expense_category'], 'exist', 'skipOnError' => true, 'targetClass' => ExpsenseCategory::className(), 'targetAttribute' => ['expense_category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'expense_category' => 'Expense Category',
            'expense_per' => 'Expense Per',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryMaster::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExpenseCategory()
    {
        return $this->hasOne(ExpsenseCategory::className(), ['id' => 'expense_category']);
    }
}
