<?php

class mdl_question
{
    private $qtype;

    public function __construct($questionid){
        global $DB;
        $sql = 'SELECT * FROM "public"."mdl_question" WHERE id = :questionid';
        $params = array('questionid' => $questionid);
        $result = $DB->get_records_sql($sql, $params);
        $this->qtype = $result[$questionid]->qtype;
    }

    /**
     * @return mixed
     */
    public function getQtype()
    {
        return $this->qtype;
    }
}