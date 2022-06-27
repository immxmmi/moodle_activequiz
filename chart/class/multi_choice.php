<?php
require_once("../../../config.php");
require_once("mdl_question_attempt_step_data.php");
global $DB;

class multi_choice
{

    private $labels = array();
    private $values = array();
    private $data = array();

    public function load_quiz_data($answers,$steps_data)
    {


        $list_user_answers = $this->filterListAnswer($steps_data);
        $row_value = $this->filterUserAnswerList($list_user_answers);

        echo "<pre>";
        print_r($row_value);
        echo "</pre>";
        /*
        $question_one = $answers[0][0];

        for ($i = 0; $i < sizeof($question_one->getQuestionsummary()); $i++) {
            $current_data = array($question_one->getQuestionsummary()[$i]=>0);
            $this->data = array_merge($this->data, $current_data);
        }

        foreach ($steps_data as $summary) {
            $responsesummary = $summary->getAnswer();
            $this->data = $this->addValue($this->data, $responsesummary);
        }

        $this->labels = array_keys($this->data);
        $this->values = array_values($this->data);
*/
        return $this->data;
    }

    private function filterListAnswer($steps_data){

        $rowListAnswer = array();
        $listAnswer = array();
        foreach ($steps_data as $data){
                array_push($rowListAnswer, $data->getAnswerList());
        }
        foreach ($rowListAnswer as $data){
                $currentUser = array();
            foreach ($data as $step_data) {
                $currentData = array(
                    $step_data->getName() => $step_data->getValue()
                );
                    array_push($currentUser,$currentData);
            }
                array_push($listAnswer, $currentUser);
        }
        return $listAnswer;
    }



    private function filterUserAnswerList($list_user_answers){

        $list_of_user_order_choice = array();

        foreach ($list_user_answers as $current_user_list) {

            $current_answer = array();
            foreach ($current_user_list as $current_user_answer) {
                $current_answer = array_merge($current_answer,$current_user_answer);
            }
                array_push($list_of_user_order_choice,$current_answer);
        }

        return $list_of_user_order_choice;

    }



    private function addValue($data, $responsesummary)
    {
        if ($responsesummary == null) {
            return $data;
        }
        $data[$responsesummary]++;
        return $data;
    }


    public function getLabels()
    {
        return $this->labels;
    }

    public function getValues()
    {
        return $this->values;
    }

}



