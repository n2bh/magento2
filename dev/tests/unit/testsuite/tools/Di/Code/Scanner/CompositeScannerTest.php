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
 * @copyright  Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

require_once realpath(dirname(__FILE__) . '/../../../../../../../') . '/tools/Di/Code/Scanner/ScannerInterface.php';
require_once realpath(dirname(__FILE__) . '/../../../../../../../') . '/tools/Di/Code/Scanner/CompositeScanner.php';

class Magento_Tools_Di_Code_Scanner_CompositeScannerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Magento\Tools\Di\Code\Scanner\CompositeScanner
     */
    protected $_model;

    protected function setUp()
    {
        $this->_model = new Magento\Tools\Di\Code\Scanner\CompositeScanner();
    }

    public function testScan()
    {
        $phpFiles = array(
            'one/file/php',
            'two/file/php',
        );
        $configFiles = array(
            'one/file/config',
            'two/file/config',
        );
        $files = array(
            'php' => $phpFiles,
            'config' => $configFiles,
        );

        $scannerPhp = $this->getMock('Magento\Tools\Di\Code\Scanner\ScannerInterface');
        $scannerXml = $this->getMock('Magento\Tools\Di\Code\Scanner\ScannerInterface');

        $scannerPhp->expects($this->once())
            ->method('collectEntities')
            ->with($phpFiles)
            ->will($this->returnValue(array('Model_OneProxy', 'Model_TwoFactory')));

        $scannerXml->expects($this->once())
            ->method('collectEntities')
            ->with($configFiles)
            ->will($this->returnValue(array('Model_OneProxy', 'Model_ThreeFactory')));

        $this->_model->addChild($scannerPhp, 'php');
        $this->_model->addChild($scannerXml, 'config');

        $actual = $this->_model->collectEntities($files);
        $expected = array('Model_OneProxy', 'Model_TwoFactory', 'Model_ThreeFactory');

        $this->assertEquals($expected, array_values($actual));
    }
}