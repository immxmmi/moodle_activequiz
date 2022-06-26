<?php
require_once("../../../config.php");
require_once("mdl_question_attempt_steps.php");
global $DB;

class attempt_step_data
{

    private $id;
    private $attemptstepid;
    private $name;
    private $value;



    public function __construct($step_id)
    {
        global $DB;

                $sql = 'SELECT * FROM "public"."mdl_question_attempt_step_data" WHERE attemptstepid = :attemptstepid';
                $params = array('attemptstepid' => $step_id);
                $step_data = $DB->get_records_sql($sql, $params);

                foreach ($step_data as $data) {
                    $this->id = $data->id;
                    $this->attemptstepid = $data->attemptstepid;
                    $this->name = $data->name;
                    echo implode(',', "a,s,d");//.$data->value);
                }
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