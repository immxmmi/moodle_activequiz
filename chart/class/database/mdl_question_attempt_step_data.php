<?php
require_once("../../../config.php");
require_once("mdl_question_attempt_steps.php");
global $DB;

class attempt_step_data
{
    private $id;
    private $questionattemptid;
    private $attemptstepid;
    private $name;
    private $value = array();
    private $answer_list = array();

    public function __construct($steps)
    {

        if ($steps != null) {

            global $DB;

            foreach ($steps as $step) {
                $step_id = $step->getId();
                $this->questionattemptid = $step->getQuestionattemptid();


                $sql = 'SELECT * FROM "public"."mdl_question_attempt_step_data" WHERE attemptstepid = :attemptstepid';
                $params = array('attemptstepid' => $step_id);
                $step_data = $DB->get_records_sql($sql, $params);


                foreach ($step_data as $data) {
                    $current_data = $this->build(
                        $data->id,
                        $data->attemptstepid,
                        $data->name,
                        explode(',', $data->value),
                        $this->questionattemptid,
                        $this->answer_list
                    );
                    array_push($this->answer_list, $current_data);
                }

            }

        }

    }

    private function build($id, $attemptstepid, $name, $value, $questionattemptid, array $answer_list)
    {
        $currentStep = new attempt_step_data(null);
        $currentStep->id = $id;
        $currentStep->attemptstepid = $attemptstepid;
        $currentStep->name = $name;
        $currentStep->value = $value;
        $currentStep->questionattemptid = $questionattemptid;
        $currentStep->answer_list = $answer_list;
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
     * @return mixed
     */
    public function getQuestionattemptid()
    {
        return $this->questionattemptid;
    }

    /**
     * @return array
     */
    public function getAnswerList()
    {
        return $this->answer_list;
    }


}