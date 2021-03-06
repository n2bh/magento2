<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Mage_Backend
 * @subpackage  unit_tests
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Backend_Model_Config_Structure_Mapper_DependenciesTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Mage_Backend_Model_Config_Structure_Mapper_Dependencies
     */
    protected $_model;

    public function setUp()
    {
        $this->_model = new Mage_Backend_Model_Config_Structure_Mapper_Dependencies(
            new Mage_Backend_Model_Config_Structure_Mapper_Helper_RelativePathConverter()
        );
    }

    public function testMap()
    {
        $data = require_once (realpath(dirname(__FILE__) . '/../../../') . '/_files/dependencies_data.php');
        $expected = require_once (realpath(dirname(__FILE__) . '/../../../') . '/_files/dependencies_mapped.php');

        $actual = $this->_model->map($data);
        $this->assertEquals($expected, $actual);
    }
}
