<?php
require_once("../../../config.php");
global $DB;

class attempt_steps
{
    private $id;
    private $questionattemptid;
    private $sequencenumber;
    private $state;
    private $fraction;
    private $timecreated;
    private $userid;

    public function __construct($questionattemptid)
    {
        global $DB;

                $sql = 'SELECT * FROM "public"."mdl_question_attempt_steps" WHERE questionattemptid = :questionattemptid';
                $params = array('questionattemptid' => $questionattemptid);
                $result = $DB->get_records_sql($sql, $params);


                foreach ($result as $answer) {
                        $this->id=$answer->id;
                        $this->questionattemptid=$answer->questionattemptid;
                        $this->sequencenumber=$answer->sequencenumber;
                        $this->state=$answer->state;
                        $this->fraction=$answer->fraction;
                        $this->timecreated=$answer->timecreated;
                        $this->userid=$answer->userid;
                }


            }

    /**
     * @return array
     */
    public function getAttemptstepids()
    {
        return $this->attemptstepids;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

}