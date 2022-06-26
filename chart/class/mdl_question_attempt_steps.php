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
    private $step_list;
    private $attemptstepids = array();
    private $answer_list = array();

    public function __construct($questionattemptid)
    {
        global $DB;
       // if ($answers !== null) {

            //foreach ($answers as $questionattemptid) {
                $sql = 'SELECT * FROM "public"."mdl_question_attempt_steps" WHERE questionattemptid = :questionattemptid';
                $params = array('questionattemptid' => $questionattemptid);
                $result = $DB->get_records_sql($sql, $params);

        echo "<pre>";
        print_r($result);
        echo "</pre>";

/*
                foreach ($result as $answer) {

                  //  $currentstep = $this->builder(
                        $this->id=$answer->id;
                        $this->questionattemptid=$answer->questionattemptid;
                        $this->sequencenumber=$answer->sequencenumber;
                        $this->state=$answer->state;
                        $this->fraction=$answer->fraction;
                        $this->timecreated=$answer->timecreated;
                        $this->userid=$answer->userid;
                        $this->answer_list=$questionattemptid[0]->getQuestionsummary();
                    //array_push($this->attemptstepids, $currentstep);

                }
*/

            }
       // }

    //}


    private function builder($id, $questionattemptid, $sequencenumber, $state, $fraction, $timecreated, $userid, array $answer_list)
    {
        $current_step = new attempt_steps(null);
        $current_step->id = $id;
        $current_step->questionattemptid = $questionattemptid;
        $current_step->sequencenumber = $sequencenumber;
        $current_step->state = $state;
        $current_step->fraction = $fraction;
        $current_step->timecreated = $timecreated;
        $current_step->userid = $userid;
        $current_step->answer_list = $answer_list;
        return $current_step;
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

    /**
     * @return array
     */
    public function getAnswerList()
    {
        return $this->answer_list;
    }

    /**
     * @param array $attemptstepids
     */

    public function setAttemptstepids($attemptstepids)
    {
        $this->attemptstepids = $attemptstepids;
    }




}