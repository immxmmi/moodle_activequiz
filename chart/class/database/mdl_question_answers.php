<?php
require_once("../../../config.php");
global $DB;

class mdl_question_answers
{
    private $answer;

    public function __construct($answerid){
        global $DB;
        $sql = 'SELECT * FROM "public"."mdl_question_answers" WHERE id = :answerid';
        $params = array('answerid' => $answerid);
        $result = $DB->get_records_sql($sql, $params);
        $this->answer = strip_tags($result[$answerid]->answer);
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }



}