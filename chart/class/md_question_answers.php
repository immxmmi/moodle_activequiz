<?php
require_once("../../../config.php");
global $DB;

class md_question_answers
{
    private $answer;

    public function __construct($answerid){
        global $DB;
        $sql = 'SELECT * FROM "public"."mdl_question_answers" WHERE id = :answerid';
        $params = array('answerid' => $answerid);
        $result = $DB->get_records_sql($sql, $params);

        echo "<pre>";
        print_r($result->answer);
        echo "</pre>";

        //$this->id = $result[0]->getId();
    }

}