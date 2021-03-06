<?php
/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-07-12 at 10:18:17.
 */
require_once dirname(__FILE__) . '/../Nal/api/app/dcconnect.php';
require_once dirname(__FILE__) . '/Stub/dcconnectStb.php';

class dcconnectTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var dcconnect
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
     * @covers dcconnect::get
     * @todo   Implement testGet().
     */
    public function testGet()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['function_type'] = 'dcconnect';
        $_GET['IaaS_tenant_id'] = '1234';
        $_SERVER['REQUEST_URI'] = "/Nal/service/?function_type=dcconnect&IaaS_tenant_id=1234";
        $ret = new dcconnect();
        $method = new ReflectionMethod($ret, 'get');
        $method->setAccessible(true);

        //case 1
        try {
            //$method->invoke($ret);
        }catch( Exception $e ) {
            $this->assertContains('API error',$e->getMessage());
        }

        //case 2
        // mock
        $stb = $this->getMock('dcconnect',array('_execApi', 'getAppliance'));
        $stb->expects($this->any())->method('_execApi')->will($this->returnValue(array('test')));
        $this->assertEquals($method->invoke($stb),'');

        // case 3
        // mock
        $stb = $this->getMock('dcconnect',array('_execApi', 'setData','success'));
        $stb->expects($this->any())->method('_execApi')->will($this->returnValue(array('test')));
        $stb->expects($this->any())->method('setData')->will($this->returnValue(array('test')));
        $stb->expects($this->any())->method('success')->will($this->returnArgument(0));
        $ret->_nalConf['api_type'] = 'wim';

        //case 4
        try {
        }catch( Exception $e ) {
            $this->assertEquals($e->getMessage(),'');
        }

        // case 5
        // mock
        $ret = new dcconnect();
        $method = new ReflectionMethod( $ret, 'get' );
        $method->setAccessible( true );

        $stb = $this->getMock('dcconnect',array('_execApi', '_getTenant', 'success'));
        $stb->expects($this->any())->method('_execApi')->will($this->returnValue(array('test')));
        $stb->expects($this->any())->method('_getTenant')->will($this->returnValue('1234'));
        $stb->expects($this->any())->method('success')->will($this->returnValue(array('test')));
        $stb->_nalConf['api_type'] = 'wim'; // Wim
        $this->assertEquals($method->invoke($stb),'');
    }

    /**
     * @covers dcconnect::post
     * @todo   Implement testPost().
     */
    public function testPost()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['function_type'] = 'dcconnect';
        $_POST['scenario']      = 'service';
        $_SERVER['REQUEST_URI'] = "/Nal/service/";
        $ret = new dcconnect();
        $method = new ReflectionMethod($ret, 'post');
        $method->setAccessible(true);

        // mock
        $stb = $this->getMock('dcconnect',array('execJobNalWim'));
        $stb->expects($this->any())->method('execJobNalWim')->will($this->returnArgument(0));

        $stb->_p['scenario'] = 'service';

        //case 1
        try {
            $this->assertEquals($method->invoke($ret),'');
        }catch( Exception $e){
            $this->assertEquals($e->getMessage(),'device_type is not set.');
        }

        $stb->_p['device_type'] = '1';
        $stb->_p['group_type'] = '1';

        //case 2
        try {
            $method->invoke($stb);
        }catch( Exception $e ) {
            $this->assertEquals($e->getMessage(),'');
        }

        // case3
        // mock
        $stb = $this->getMock('dcconnect',array('execJobNalWim', 'checkJobForDbWim'));
        $stb->expects($this->any())->method('execJobNalWim')->will($this->returnArgument(0));
        $stb->expects($this->any())->method('checkJobForDbWim')->will($this->returnArgument(0));
        $stb->_nalConf['api_type'] = 'wim'; // Wim
        $stb->_p['device_type'] = '1';
        $stb->_p['group_type'] = '1';
        $method->setAccessible( true );
        $this->assertEquals($method->invoke($stb),'');
    }

    /**
     * @covers dcconnect::put
     * @todo   Implement testPut().
     */
    public function testPut()
    {
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        $_POST['function_type'] = 'dcconnect';
        $_POST['scenario']      = 'service';
        $ret = new dcconnect();
        $method = new ReflectionMethod($ret, 'put');
        $method->setAccessible(true);

        // mock
        $stb = $this->getMock('dcconnect',array('execJobNalWim'));
        $stb->expects($this->any())->method('execJobNalWim')->will($this->returnArgument(0));

        $stb->_p['scenario'] = 'service';

        //case 1
        try {
            $this->assertEquals($method->invoke($ret),'');
        }catch( Exception $e){
            $this->assertEquals($e->getMessage(),'device_type is not set.');
        }

        $stb->_p['device_type'] = '1';
        $stb->_p['group_type'] = '1';

        //case 2
        try {
            $method->invoke($stb);
        }catch( Exception $e ) {
            $this->assertEquals($e->getMessage(),'');
        }

        // case3
        // mock
        $stb = $this->getMock('dcconnect',array('execJobNalWim', 'checkJobForDbWim'));
        $stb->expects($this->any())->method('execJobNalWim')->will($this->returnArgument(0));
        $stb->expects($this->any())->method('checkJobForDbWim')->will($this->returnArgument(0));
        $stb->_nalConf['api_type'] = 'wim'; // Wim
        $stb->_p['device_type'] = '1';
        $stb->_p['group_type'] = '1';
        $method->setAccessible( true );
        $this->assertEquals($method->invoke($stb),'');
    }


    /**
     * @covers dcconnect::delete
     * @todo   Implement testDelete().
     */
    public function testDelete()
    {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_POST['function_type'] = 'dcconnect';
        $_POST['scenario']      = 'service';
        $ret = new dcconnect();
        $method = new ReflectionMethod($ret, 'delete');
        $method->setAccessible(true);

        // mock
        $stb = $this->getMock('dcconnect',array('execJobNalWim'));
        $stb->expects($this->any())->method('execJobNalWim')->will($this->returnArgument(0));

        $stb->_p['scenario'] = 'service';
        $stb->_p['device_type'] = '1';
        $stb->_p['group_type'] = '1';

        //case 1
        try {
            $method->invoke($stb);
        }catch( Exception $e ) {
            $this->assertEquals($e->getMessage(),'');
        }

        // case2
        // mock
        $stb = $this->getMock('dcconnect',array('_getGroupId','execJobNalWim','checkJobForDbWim'));
        $stb->expects($this->any())->method('_getGroupId')->will($this->returnValue('1234'));
        $stb->expects($this->any())->method('execJobNalWim')->will($this->returnArgument(0));
        $stb->expects($this->any())->method('checkJobForDbWim')->will($this->returnArgument(0));
        $stb->_nalConf['api_type'] = 'wim'; // Wim
        $stb->_p['device_type'] = '1';
        $stb->_p['group_type'] = '1';
        $method->setAccessible( true );
        $this->assertEquals($method->invoke($stb),'');

    }

    /**
     * @covers dcconnect::execJobNalWim
     * @todo   Implement testExecJobNalWim().
     */
    public function testExecJobNalWim()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['function_type'] = 'dcconnect';
        $_POST['scenario']      = 'service';

        $ret = new dcconnect();
        $method = new ReflectionMethod($ret, 'execJobNalWim');
        $method->setAccessible(true);

        // mock
        $stb = $this->getMock('dcconnect',array('callJobScheduler','callJobCenterNalWim'));
        $stb->expects($this->any())->method('callJobScheduler')->will($this->returnArgument(0));
        $stb->expects($this->any())->method('callJobCenterNalWim')->will($this->returnArgument(0));

        // case 1
        $stb->_nalConf['job_type'] = '1';
        $this->assertEquals($method->invoke($stb),'');

        // case 2
        $stb->_nalConf['job_type'] = '2';
        $this->assertEquals($method->invoke($stb),'');
    }

    /**
     * @covers dcconnect::callJobCenterNalWim
     * @todo   Implement testCallJobCenterNalWim().
     */
    public function testCallJobCenterNalWim()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['function_type'] = 'dcconnect';
        $_POST['scenario']      = 'service';

        $ret = new dcconnect();
        // job param
        $ret->_p['request-id'] = '123456';
        $trans = array(
            '%ROOT_DIR%' => $ret->_nalConf['root_inoutfile'],
            '%UUID%'     => $ret->_p['request-id'],
        );
        $dir = strtr( neccsNal_Config::DIR_PATH, $trans );
        $ret->jobCenterParam      ="'" . $dir . " " . neccsNal_Config::IN_FILE . " " . neccsNal_Config::OUT_FILE . "'";
        $ret->jobCenterOperation = "create-dcconnect";
        $method = new ReflectionMethod($ret, 'callJobCenterNalWim');
        $method->setAccessible(true);

        // case 1
        try {
            $this->assertEquals($method->invoke($ret),'');
        }catch( Exception $e){
            $this->assertEquals($e->getMessage(),'device_type is not set.');
        }

        // case 2
        $ret->_p['device_type'] = "1";
        $ret->_p['group_type'] = "1";
        $ret->_p['job_out'] = "jc-sv01:nsumsmgr:create-dcconnect.20160706040616.nstrk";
        $this->assertEquals($method->invoke($ret),'');

        // case 2
        $ret->_nalConf['api_type'] = 'wim';
        $this->assertEquals($method->invoke($ret),'');

        // case 3
        try {
            $ret->_nalConf['api_type'] = 'nal';
            $ret->_p['job_out'] = '';
            $this->assertEquals($method->invoke($ret),'');
        }catch( Exception $e){
            $this->assertContains('Out params was not returned.',$e->getMessage());
        }
    }

    /**
     * @covers dcconnect::_execApi
     * @todo   Implement testExecApi().
     */
    public function testExecApi()
    {
         $_SERVER['REQUEST_METHOD'] = 'GET';
         $_GET['function_type'] = 'dcconnect';
         $_SERVER['REQUEST_URI'] = "/Nal/node/";
         $ret = new dcconnect();

         // case 1
         $url = 'http://127.0.0.1/nalapi/test.html';
         $method = new ReflectionMethod($ret, '_execApi');
         $method->setAccessible(true);
         try {
             $method->invoke($ret,$url,array(),1);
         }catch( Exception $e) {
             $this->assertContains('API error',$e->getMessage());
         }

         // case 2
         $stb = $this->getMock('dcconnect',array('error'));
         $stb->expects($this->any())->method('error')->will($this->returnValue('error'));
         $this->assertEquals($method->invoke($stb,$url,array(),1),null);

         // case 3
         $url = 'http://127.0.0.1/Nal/';
         $method = new ReflectionMethod($ret, '_execApi');
         $method->setAccessible(true);
         $this->assertArrayHasKey('request-id',$method->invoke($ret,$url,array(),1));

         // case 4
         $_SERVER['REQUEST_METHOD'] = 'POST';
         $_POST['function_type'] = 'dcconnect';
        $_POST['scenario']      = 'service';
         $ret = new dcconnect();
         $url = 'http://127.0.0.1/Nal/';
         $method = new ReflectionMethod($ret, '_execApi');
         $method->setAccessible(true);
         $this->assertArrayHasKey('request-id',$method->invoke($ret,$url,array(),1));

         // case 5 ( apache no setup  webdav setup)
         $_SERVER['REQUEST_METHOD'] = 'DELETE';
         $_POST['function_type'] = 'dcconnect';
         $_SERVER['REQUEST_URI'] = "/Nal/node/";
         $ret = new dcconnect();
         $url = 'http://127.0.0.1/nalapi/phpunit/Stub/test.json';
         $method = new ReflectionMethod($ret, '_execApi');
         $method->setAccessible(true);
         try {
             $method->invoke($ret,$url,array(),1);
         }catch( Exception $e) {
             $this->assertContains('API error',$e->getMessage());
         }
    }

    /**
     * @covers dcconnect::_execWimApi
     * @todo   Implement testExecWimApi().
     */
    public function testExecWimApi()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['function_type'] = 'dcconnect';
        $_POST['scenario']      = 'service';
        $ret = new dcconnect();
        $ret->_p['request-id'] = '123456';

        // case 1
        $url = 'http://127.0.0.1/nalapi/test.html';
        $method = new ReflectionMethod($ret, '_execWimApi');
        $method->setAccessible(true);
        try {
            $method->invoke($ret,$url,array(),'POST',1);
        }catch( Exception $e) {
            $this->assertContains('API error',$e->getMessage());
        }

        // case 2
        $stb = $this->getMock('dcconnect',array('error'));
        $stb->expects($this->any())->method('error')->will($this->returnValue('error'));
        $this->assertEquals($method->invoke($stb,$url,array(),'POST',1),null);

        // case 3
        $url = 'http://127.0.0.1/Nal/';
        $method = new ReflectionMethod($ret, '_execWimApi');
        $method->setAccessible(true);
        $this->assertArrayHasKey('request-id',$method->invoke($ret,$url,array(),'POST',1));

        // case 4 ( apache no setup  webdav setup)
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_POST['function_type'] = 'dcconnect';
        $_SERVER['REQUEST_URI'] = "/Nal/node/";
        $ret = new dcconnect();
        $url = 'http://127.0.0.1/Nal/';
        $method = new ReflectionMethod($ret, '_execWimApi');
        $method->setAccessible(true);
        try {
            $method->invoke($ret,$url,array(),'DELETE',1);
        }catch( Exception $e) {
            $this->assertContains('API error',$e->getMessage());
        }

        // case 5
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['function_type'] = 'dcconnect';
        $_SERVER['REQUEST_URI'] = "/Nal/node/";
        $ret = new dcconnect();
        $url = 'http://127.0.0.1/Nal/';
        $method = new ReflectionMethod($ret, '_execWimApi');
        $method->setAccessible(true);
        try {
            $method->invoke($ret,$url,array(),'GET',1);
        }catch( Exception $e) {
            $this->assertContains('API error',$e->getMessage());
        }
    }

    /**
     * @covers dcconnect::_execResult
     * @todo   Implement testExecResult().
     */
    public function testExecResult()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['function_type'] = 'dcconnect';
        $_SERVER['REQUEST_URI'] = "/Nal/node/";
        $ret = new dcconnect();
        $method = new ReflectionMethod($ret, '_execResult');
        $method->setAccessible(true);

        $url = 'http://127.0.0.1/Nal/';

        // case 1
        $err = array();
        $this->assertEquals($method->invoke($ret,$err,$url),'');

        // case 2
        $err['result'] = array( 'error-code' => 'NAL100000', 'message' => '' );
        try{
            $method->invoke($ret,$err,$url);
        }catch(Exception $e){
            $this->assertEquals('',$e->getMessage());
        }

        // case 3
        $err['result'] = array( 'error-code' => 'NAL140001', 'message' => 'test' );
        try{
            $method->invoke($ret,$err,$url);
        }catch(Exception $e){
            $this->assertEquals('test',$e->getMessage());
        }
    }

    /**
     * @covers dcconnect::checkJobForDbWim
     * @todo   Implement TestCheckJobForDbWim().
     */
    public function testCheckJobForDbWim()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['function_type'] = 'dcconnect';
        $_POST['scenario']      = 'service';
        $ret = new dcconnect();

        $method = new ReflectionMethod($ret, 'checkJobForDbWim');
        $method->setAccessible(true);

        // case 1
        $stb = $this->getMock('dcconnect',array('_execWimApi'));
        $stb->expects($this->any())->method('_execWimApi')->will($this->returnValue(array( '0' => array( 'task_status' => 'test_status' ))));
        $this->assertEquals( $method->invoke($stb,3,5),'');

        // case 2
        try {
            $method->invoke($stb,2,2);
        } catch( Exception $e ){
            $this->assertEquals($e->getMessage(),'It is in the unjust status. status : test_status');
        }

        // case 3
        $stb = $this->getMock('dcconnect',array('_execWimApi','error'));
        $stb->expects($this->any())->method('_execWimApi')->will($this->returnValue(array( '0' => array( 'task_status' => NULL ))));
        $stb->expects($this->any())->method('_error')->will($this->returnArgument(0));
        $this->assertEquals( $method->invoke($stb,2,3),'');

        // case 4
        try {
            $method->invoke($stb,2,2);
        } catch( Exception $e ){
            $this->assertEquals($e->getMessage(),'Condition error of the retry number of times. retry : 2');
        }

        // case 5
        $stb = $this->getMock('dcconnect',array('_execWimApi'));
        $stb->expects($this->any())->method('_execWimApi')->will($this->returnValue(array( '0' => array( 'task_status' => '0' ))));
        $this->assertEquals( $method->invoke($stb,3,6),'');

        // case 6
        try {
            $method->invoke($stb,2,2);
        } catch( Exception $e ){
            $this->assertEquals($e->getMessage(),'Condition error of the retry number of times. retry : 2');
        }

        // case 7
        $stb = $this->getMock('dcconnect',array('_execWimApi','_deleteDirectory','success'));
        $stb->expects($this->any())->method('_execWimApi')->will($this->returnValue(array( '0' => array( 'task_status' => '1' ))));
        $stb->expects($this->any())->method('_deleteDirectory')->will($this->returnArgument(0));
        $stb->expects($this->any())->method('success')->will($this->returnArgument(0));
        $this->assertEquals( $method->invoke($stb,2,6),'');
    }

    /**
     *  deleteDirectory
     */
    private function _deleteDirectory( $filePath ) {

        if( file_exists( $filePath ) ) {
            if ( $handle = opendir( "$filePath" ) ) {
                while ( ( $item = readdir( $handle ) ) !== false ) {
                    if ( $item != "." && $item != ".." ) {
                        unlink( "$filePath/$item" );
                    }
                }
                closedir( $handle );
                rmdir( $filePath );
            }
        }
    }

    /**
     * @covers dcconnect::setData
     * @todo   Implement testSetData().
     */
    public function testSetData(){

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['function_type'] = 'dcconnect';
        $_SERVER['REQUEST_URI'] = "/Nal/service/";
        $ret = new dcconnect();

        $method = new ReflectionMethod($ret, 'setData');
        $method->setAccessible(true);

        $res = array(
            'dc_info' => array ( '0' => array('dc_id'=>'1234','dc_name'=>'dc_1') ),
            'dc_group_info' => array ( '0' => array('dc_id'=>'1234','dc_name'=>'dc_1') ),
            'dc_member_info' => array ( '0' => array('dc_id'=>'1234','group_id'=>'1')),
        );

        // case 1
        $result = $method->invoke($ret,$res);
        $this->assertArrayHasKey('dc_id', $result['dc_member_info'][0]);
    }

    /**
     * @covers dcconnect::getAppliance
     * @todo   Implement testGetAppliance().
     */
    public function testGetAppliance(){

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['function_type'] = 'dcconnect';
        $_SERVER['REQUEST_URI'] = "/Nal/service/";
        $ret = new dcconnect();

        $method = new ReflectionMethod($ret, 'getAppliance');
        $method->setAccessible(true);

        $res = array(
            'data' => array(
                'dc_info' => array ( '0' => array('dc_id'=>'1234','dc_name'=>'dc_1') ),
                'dc_group_info' => array ( '0' => array('dc_id'=>'1234','dc_name'=>'dc_1') ),
                'dc_member_info' => array ( '0' => array('dc_id'=>'1234','group_id'=>'1', 'ce1_node_id' => '5678')),
            )
        );

        // case 1
        $stb = $this->getMock('dcconnect',array('_execApi'));
        $stb->expects($this->any())->method('_execApi')->will($this->returnValue(1));
        $stb->_p['dc_id'] = '1234';
        $this->assertEquals( $method->invoke($stb,$res),'1');

        $res = array(
            'data' => array(
                'dc_info' => array ( '0' => array('dc_id'=>'1234','dc_name'=>'dc_1') ),
                'dc_group_info' => array ( '0' => array('dc_id'=>'1234','dc_name'=>'dc_1') ),
                'dc_member_info' => array ( '0' => array('dc_id'=>'1234','group_id'=>'1', 'ce1_node_id' => '')),
            )
        );

        // case 2
        $stb = $this->getMock('dcconnect',array('_execApi'));
        $stb->expects($this->any())->method('_execApi')->will($this->returnValue(1));
        $stb->_p['dc_id'] = '1234';
        $this->assertEquals( $method->invoke($stb,$res),array());

        $res = array(
            'data' => array(
                'dc_info' => array ( '0' => array('dc_id'=>'1234','dc_name'=>'dc_1') ),
                'dc_group_info' => array ( '0' => array('dc_id'=>'1234','dc_name'=>'dc_1') ),
                'dc_member_info' => array ( '0' => array('dc_id'=>'1234','group_id'=>'1') ),
            )
        );
        $result['data'][0] = $res;

        // case 3
        $stb = $this->getMock('dcconnect',array('_execApi'));
        $stb->expects($this->any())->method('_execApi')->will($this->returnValue(1));
        $stb->_p['dc_id'] = '1234';
        $this->assertEquals( $method->invoke($stb,$res),array());
    }

    /**
     * @covers dcconnect::_getGroupId
     * @todo   Implement testGetGroupId().
     */
    public function testGetGroupId(){

        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_GET['function_type'] = 'dcconnect';
        $_SERVER['REQUEST_URI'] = "/Nal/service/";
        $ret = new dcconnect();

        $method = new ReflectionMethod($ret, '_getGroupId');
        $method->setAccessible(true);

        $res = array(
            '0' => array(
                'group_id' => '12345'
            )
        );

        // case 1
        $stb = $this->getMock('dcconnect',array('_execWimApi'));
        $stb->expects($this->any())->method('_execWimApi')->will($this->returnValue($res));
        $this->assertEquals( $method->invoke($stb),'12345');
    }

    /**
     *  remove Dir
     */
    function removeDir( $dir ) {

        $cnt = 0;
        if(!is_dir($dir)){
            return;
        }
        $handle = opendir($dir);
        if (!$handle) {
            return ;
        }
        while (false !== ($item = readdir($handle))) {
            if ($item === "." || $item === "..") {
                continue;
            }
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            if (is_dir($path)) {
                $cnt = $cnt + $this->removeDir($path);
            } else {
                chmod($path,0644);
                @unlink($path);
            }
        }
        closedir($handle);
        if (!@rmdir($dir)) {
            return ;
        }
    }

    /**
     *  After action
     */
    public function testAfterAction() {
        // after job
        $dir = neccsNal_Config::LOG_DIR . "/job";
        $this->removeDir($dir);
    }
}