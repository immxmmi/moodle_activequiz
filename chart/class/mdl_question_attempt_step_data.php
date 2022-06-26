<?php
require_once("../../../config.php");
require_once("mdl_question_attempt_steps.php");
global $DB;

class attempt_step_data
{

    private $id;
    private $attemptstepid;
    private $name;
    private $value = array();
    private $answer_list = array();



    public function __construct($step_id)
    {
        echo $step_id;
        global $DB;

                $sql = 'SELECT * FROM "public"."mdl_question_attempt_step_data" WHERE attemptstepid = :attemptstepid';
                $params = array('attemptstepid' => $step_id);
                $step_data = $DB->get_records_sql($sql, $params);


                foreach ($step_data as $data) {
                    $currentstep = $this->builder(
                        $data->id,
                        $data->attemptstepid,
                        $data->name,
                        explode(',', $data->value),
                        $this->answer_list);
                    array_push($this->answer_list, $currentstep);
                }
    }


    private function build($id, $attemptstepid, $name, $value, array $answer_list)
    {
        $currentStep = new attempt_step_data(null);
        $currentStep->id = $id;
        $currentStep->attemptstepid = $attemptstepid;
        $currentStep->name = $name;
        $currentStep->value = $value;
        $currentStep->answer_list = $answer_list;
        $currentStep->answer = $answer_list[$currentStep->value];
        return $currentStep;
    }




    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAttemptstepid()
    {
        return $this->attemptstepid;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function getStepDataList()
    {
        return $this->step_data_list;
    }



}