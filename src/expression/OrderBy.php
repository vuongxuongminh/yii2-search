<?php
/**
 * @link https://github.com/vuongxuongminh/yii2-searchable
 * @copyright Copyright (c) 2019 Vuong Xuong Minh
 * @license [New BSD License](http://www.opensource.org/licenses/bsd-license.php)
 */

namespace vxm\searchable\expression;

use yii\db\Expression as DbExpression;
use yii\db\ExpressionInterface;

/**
 * Class OrderBy support add order by search result for make result have been order by exact ids.
 *
 * @author Vuong Minh <vuongxuongminh@gmail.com>
 * @since 1.0.0
 */
class OrderBy extends Expression
{

    /**
     * @inheritDoc
     * @return ExpressionInterface|OrderBy
     */
	public function getExpression(): ExpressionInterface {
		$position = 1;
		$cases = ['CASE'];
		$searchableKey = $this->searchableKey ();

		foreach ( $this->ids as $id ) {
			$cases [] = "WHEN {$searchableKey} = $id THEN {$position}";
			$position ++;
		}

		$cases [] = "ELSE {$position}";
		$cases [] = 'END ASC'; 

		return new DbExpression ( implode ( ' ', $cases ) );
	}


}
