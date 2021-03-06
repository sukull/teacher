<?php
class AcademyTest extends PHPUnit_Framework_TestCase {
    private $ci;
    private $em;
    private $user;
    private $academy;

    public function __construct() {
        //$this->loadci();
    }
    public function loadci() {

        $this->ci = &get_instance();

        $this->ci->load->library('doctrine');
        $this->ci->load->library('session');
        $this->em = &$this->ci->doctrine->em;
        $this->user = &$this->em->getRepository('Entity\Member')->findOneBy(array('email'=>'c@c.c'));

        $this->session->set_userdata('user-id', $this->user->getId());
        //$this->ci->load->library('academy', array('user'=>$this->user));
        $this->academy = &$this->ci->academy;
        echo 'cool';
    }
    public function test_signin() {
        $this->loadci();
        $this->assertEquals($this->user->getEmail(), 'c@c.c');
    }

    public function test_add_file() {
        $this->loadci();
        $name = 'form1'; $data = 'cool, pas cool simple';
        $type = 1;
        $file = $this->academy->add_file($name, $data, $type);
        $this->assertGreaterThan(0, $file->getId());
        return $file->getId();
    }

    /**
     * @depends test_add_file
     */
    public function test_get_files($id) {
        $this->loadci();
        $files = $this->academy->get_files();
        $this->assertNotEmpty($files);
        $last = $files[count($files)-1];
        $this->assertEquals($last->getId(), $id);
    }



    public function test_add_classroom() {
        $this->loadci();
        $name = 'form1'; $code = 'f1';  $school = 'lby';
        $classroom = $this->academy->add_classroom($name, $code, $school);
        $this->assertNotNull($classroom->getId());
        return $classroom->getId();
    }

    /**
     * @depends test_add_classroom
     */
    public function test_get_classrooms($id) {
        $this->loadci();
        $classrooms = $this->academy->get_classrooms();
        $this->assertNotEmpty($classrooms);
        $last = $classrooms[count($classrooms)-1]->getClassroom();
        $this->assertEquals($last->getId(), $id);
    }

    /**
     * @depends test_add_classroom
     */
    public function test_get_classroom($id) {
        $this->loadci();
        $classroom = $this->academy->get_classroom($id);
        $this->assertNotNull($classroom);
        $this->assertEquals($classroom->getId(), $id);
    }


    /**
     * @depends test_add_classroom
     */
    public function test_add_student($clid) {
        $this->loadci();
        $name = 'pablo picasson'; $email = 'picasso@ischool.cm'; $phone = '75';
        $img = 'img/avatar-default.png';
        $std = $this->academy->add_student($name, $email, $phone, 1, $img, $clid);
        $this->assertGreaterThan(0, $std->getId());
        return $std->getId();
    }

    /**
     * @depends test_add_classroom
     * @depends test_add_student
     */
    public function test_get_studens($clid, $stdid) {
        $this->loadci();
        $students = $this->academy->get_students($clid);
        $this->assertNotEmpty($students);
        $last = $students[count($students)-1];
        $this->assertEquals($last->getId(), $stdid);
    }


    /**
     * @depends test_add_classroom
     */
    public function test_add_test($clid) {
        $this->loadci();
        $code = 'perso-1'; $perc = 30; $sub = 'maths'; $seq = 2; $date='2014-12-27';

        $test = $this->academy->add_test($code, $perc, $sub, $seq, $date, $clid);
        $this->assertGreaterThan(0, $test->getId());
        return $test->getId();
    }

    /**
     * @depends test_add_test
     */
    public function test_get_tests($id) {
        $this->loadci();
        $tests = $this->academy->get_tests();
        $this->assertNotEmpty($tests);
        $last = $tests[count($tests)-1];
        $this->assertEquals($last->getId(), $id);
        //print_r($last);
    }

    /**
     * @depends test_add_test
     * @depends test_add_student
     */
    public function test_add_mark($tid, $stdid) {
        $this->loadci();
        $value = 16.5;
        $mark = $this->academy->add_mark($stdid, $value, $tid);
        $this->assertGreaterThan(0, $mark->getId());
        return $mark->getId();
    }

    /**
     * @depends test_add_mark
     * @depends test_add_test
     */
    public function test_get_marks($mid, $tid) {
        $this->loadci();
        $marks = $this->academy->get_marks($tid);
        $this->assertNotEmpty($marks);
        $last = $marks[count($marks)-1];
        $this->assertEquals($last->getId(), $mid);
    }

    /**
     * @depends test_add_test
     */
    public function test_del_test($tid){
        return;
        $this->loadci();
        $tests = $this->academy->get_tests();
        $this->assertNotEmpty($tests);
        $last = $tests[count($tests)-1];
        $this->assertEquals($last->getId(), $tid);
        $this->assertEquals($last->getActive(), 1);
        $this->academy->del_test($tid);
        $this->assertEquals($last->getActive(), 0);
        //print_r($last);
    }

    /**
     * @depends test_add_classroom
     * @depends test_add_student
     */
    public function test_del_student($clid, $stid){
        $this->loadci();
        $students = $this->academy->get_students($clid);
        $this->assertNotEmpty($students);
        $last = $students[count($students)-1];
        $this->assertEquals($last->getId(), $stid);
        $this->assertEquals($last->getActive(), 1);
        $this->academy->del_student($stid);
        $this->assertEquals($last->getActive(), 0);
        //print_r($last);
    }

    /**
     * @depends test_add_classroom
     */
    public function test_del_classroom($clid){
        $this->loadci();
        $classrooms = $this->academy->get_classrooms();
        $this->assertNotEmpty($classrooms);
        $last = $classrooms[count($classrooms)-1];
        $this->assertEquals($last->getClassroom()->getId(), $clid);
        $this->assertEquals($last->getActive(), 1);
        $this->academy->del_classroom($clid);
        $this->assertEquals($last->getActive(), 0);
        //print_r($last);
    }

    /*
    public function test_del_student($stid){

    }

    public function test_del_classroom($clid){

    }
    */
}

?>