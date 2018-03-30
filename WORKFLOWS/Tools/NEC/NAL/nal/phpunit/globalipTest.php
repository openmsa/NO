<?php
/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-02 at 11:49:12.
 */

require_once dirname(__FILE__) . '/../Nal/api/app/globalip.php';

class globalipTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var globalip
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        if( !defined('PHPUNIT_RUN')) {
            define( 'PHPUNIT_RUN', 1 );
        }
        $this->homeDir = realpath( dirname(__FILE__) ) ;
        if( !defined('HOME_DIR')) {
            define( 'HOME_DIR', $this->homeDir );
        }
        if( !defined('API_DIR')) {
            define( 'API_DIR' , HOME_DIR . '' );
        }
        if( !defined('APP_DIR')) {
            define( 'APP_DIR' , API_DIR . '/Stub' );
        }
    }

   /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers globalip::get
     * @todo   Implement testGet().
     */
    public function testGet()
    {
        // case 1
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/Nal/resource/?function_type=globalip';
        $_GET['function_type']    = 'globalip';
        $_GET['scenario']         = 'resource';

        $ret = new globalip();
        $method = new ReflectionMethod( $ret, 'get' );
        $method->setAccessible( true );

        $apiResult = array(
          'appliances_info' => array(
            array(
              'node_id' => 'node_id_00001',
              'node_name' => 'node_name_AAA'
            )
          ),
          'tenants_info' => array(
            array(
              'tenant_name' => 'tenant_name_AAA',
              'IaaS_tenant_id' => 'IaaS_tenant_id_00001'
            )
          ),
          'global_ip_address_info' => array(
            array(
              'ID' => '10001',
              'global_ip' => 'aaaa-bbbb-cccc',
              'node_id' => 'node_id_00001',
              'tenant_name' => 'tenant_name_AAA',
              'status' => '101'
            )
          )
        );

        //case 1
        $stb = $this->getMock('globalip',array('_execMultiApi', '_getContInfo', 'success'));
        $stb->expects($this->any())->method('_execMultiApi')->will($this->returnValue($apiResult));
        $stb->expects($this->any())->method('_getContInfo')->will($this->returnArgument(2));
        $stb->expects($this->any())->method('success')->will($this->returnArgument(0));
        $this->assertEquals( $method->invoke($stb),'');

    }

    /**
     * @covers globalip::_getContInfo
     * @todo   Implement testGetContInfo().
     */
    public function testGetContInfo(){
        // case 1
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/Nal/resource/?function_type=globalip';
        $_GET['function_type']    = 'globalip';
        $_GET['scenario']         = 'resource';
        $_GET['nw_resource_kind'] = '1';

        $ret = new globalip();
        $method = new ReflectionMethod( $ret, '_getContInfo' );
        $method->setAccessible( true );

        $apiResult = array(
          'appliances_info' => array(
            array(
              'node_id' => 'node_id_00001',
              'node_name' => 'node_name_AAA'
            )
          ),
          'tenants_info' => array(
            array(
              'tenant_name' => 'tenant_name_AAA',
              'IaaS_tenant_id' => 'IaaS_tenant_id_00001'
            )
          ),
          'global_ip_address_info' => array(
            array(
              'ID' => '10001',
              'global_ip' => 'aaaa-bbbb-cccc',
              'node_id' => 'node_id_00001',
              'tenant_name' => 'tenant_name_AAA',
              'status' => '101'
            )
          ),
          'tenant_contract_info' => array(
            array(
              'ID' => '10001',
              'tenant_name' => 'tenant_name_AAA',
              'nw_resource_kind' => '2',
              'contract' => '2',
            ),
            array(
              'ID' => '10002',
              'tenant_name' => 'tenant_name_AAA',
              'nw_resource_kind' => '2',
              'contract' => '2',
            ),
            array(
              'ID' => '10003',
              'tenant_name' => 'tenant_name_BBB',
              'nw_resource_kind' => '2',
              'contract' => '3',
            )
          )
        );

        //case 1
        $stb = $this->getMock('globalip',array( '_getQuotaGlobalip', '_getContractCntGlobalip', '_getUseCntGlobalip', '_getUnavailableCntGlobalip'));
        $stb->expects($this->any())->method('_getQuotaGlobalip')->will($this->returnValue(7));
        $stb->expects($this->any())->method('_getContractCntGlobalip')->will($this->returnValue(5));
        $stb->expects($this->any())->method('_getUseCntGlobalip')->will($this->returnValue(3));
        $stb->expects($this->any())->method('_getUnavailableCntGlobalip')->will($this->returnValue(2));

        $result = $method->invoke($ret, $apiResult);
        $count = count( $result['contract_info'] );
        $this->assertEquals( $count, 1);

        $apiResult = array(
          'appliances_info' => array(),
          'tenants_info' => array(
            array(
              'tenant_name' => 'tenant_name_AAA',
              'IaaS_tenant_id' => 'IaaS_tenant_id_00001'
            )
          ),
          'global_ip_address_info' => array(
            array(
              'ID' => '10001',
              'global_ip' => 'aaaa-bbbb-cccc',
              'node_id' => 'node_id_00001',
              'tenant_name' => 'tenant_name_AAA',
              'status' => '203'
            )
          ),
          'tenant_contract_info' => array(
            array(
              'ID' => '10001',
              'tenant_name' => 'tenant_name_AAA',
              'nw_resource_kind' => '2',
              'contract' => '2',
            ),
            array(
              'ID' => '10002',
              'tenant_name' => 'tenant_name_AAA',
              'nw_resource_kind' => '2',
              'contract' => '2',
            ),
            array(
              'ID' => '10003',
              'tenant_name' => 'tenant_name_BBB',
              'nw_resource_kind' => '2',
              'contract' => '3',
            )
          )
        );

        //case 2
        $stb = $this->getMock('globalip',array('_getQuotaGlobalip', '_getContractCntGlobalip', '_getUseCntGlobalip', '_getUnavailableCntGlobalip'));
        $stb->expects($this->any())->method('_getQuotaGlobalip')->will($this->returnValue(7));
        $stb->expects($this->any())->method('_getContractCntGlobalip')->will($this->returnValue(5));
        $stb->expects($this->any())->method('_getUseCntGlobalip')->will($this->returnValue(3));
        $stb->expects($this->any())->method('_getUnavailableCntGlobalip')->will($this->returnValue(2));

        $result = $method->invoke($ret, $apiResult);
        $count = count( $result['contract_info'] );
        $this->assertEquals( $count, 1);

        $apiResult = array(
          'appliances_info' => array(
            array(
              'node_id' => 'node_id_00001',
              'node_name' => 'node_name_AAA'
            )
          ),
          'tenants_info' => array(),
          'global_ip_address_info' => array(
            array(
              'ID' => '10001',
              'global_ip' => 'aaaa-bbbb-cccc',
              'node_id' => 'node_id_00001',
              'tenant_name' => 'tenant_name_AAA',
              'status' => '0'
            )
          ),
          'tenant_contract_info' => array(
            array(
              'ID' => '10001',
              'tenant_name' => 'tenant_name_AAA',
              'nw_resource_kind' => '2',
              'contract' => '2',
            ),
            array(
              'ID' => '10002',
              'tenant_name' => 'tenant_name_AAA',
              'nw_resource_kind' => '2',
              'contract' => '2',
            ),
            array(
              'ID' => '10003',
              'tenant_name' => 'tenant_name_BBB',
              'nw_resource_kind' => '2',
              'contract' => '3',
            )
          )
        );

        //case 3
        $stb = $this->getMock('globalip',array('_getQuotaGlobalip', '_getContractCntGlobalip', '_getUseCntGlobalip', '_getUnavailableCntGlobalip'));
        $stb->expects($this->any())->method('_getQuotaGlobalip')->will($this->returnValue(7));
        $stb->expects($this->any())->method('_getContractCntGlobalip')->will($this->returnValue(5));
        $stb->expects($this->any())->method('_getUseCntGlobalip')->will($this->returnValue(3));
        $stb->expects($this->any())->method('_getUnavailableCntGlobalip')->will($this->returnValue(2));

        $result = $method->invoke($ret, $apiResult);
        $count = count( $result['contract_info'] );
        $this->assertEquals( $count, 1);

        $apiResult = array(
          'appliances_info' => array(
            array(
              'node_id' => 'node_id_00001',
              'node_name' => 'node_name_AAA'
            )
          ),
          'tenants_info' => array(
            array(
              'tenant_name' => 'tenant_name_AAA',
              'IaaS_tenant_id' => 'IaaS_tenant_id_00001'
            )
          ),
          'global_ip_address_info' => array(
          ),
          'tenant_contract_info' => array(
            array(
              'ID' => '10001',
              'tenant_name' => 'tenant_name_AAA',
              'nw_resource_kind' => '2',
              'contract' => '2',
            ),
            array(
              'ID' => '10002',
              'tenant_name' => 'tenant_name_AAA',
              'nw_resource_kind' => '2',
              'contract' => '2',
            ),
            array(
              'ID' => '10003',
              'tenant_name' => 'tenant_name_BBB',
              'nw_resource_kind' => '2',
              'contract' => '3',
            )
          )
        );

        //case 4
        $stb = $this->getMock('globalip',array('_getQuotaGlobalip', '_getContractCntGlobalip', '_getUseCntGlobalip', '_getUnavailableCntGlobalip'));
        $stb->expects($this->any())->method('_getQuotaGlobalip')->will($this->returnValue(7));
        $stb->expects($this->any())->method('_getContractCntGlobalip')->will($this->returnValue(5));
        $stb->expects($this->any())->method('_getUseCntGlobalip')->will($this->returnValue(3));
        $stb->expects($this->any())->method('_getUnavailableCntGlobalip')->will($this->returnValue(2));

        $result = $method->invoke($ret, $apiResult);
        $count = count( $result['contract_info'] );
        $this->assertEquals( $count, 0);

    }
}