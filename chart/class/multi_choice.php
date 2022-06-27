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

        echo "<pre>";
        //print_r($steps_data);
        echo "</pre>";

        $this->filterListAnswer($steps_data);

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

        $listAnswer = array();
        $listAnswer2 = array();
        foreach ($steps_data as $data){
                array_push($listAnswer, $data->getAnswerList());
        }
        foreach ($listAnswer as $data){


            foreach ($data as $step_data) {

                echo "<pre>";
                print_r($step_data);
                echo "</pre>";
                //array_push($listAnswer2, $data->getValue());

                break;

            }
            break;

        }
/*
        echo "<pre>";
        print_r($listAnswer);
        echo "</pre>";
*/


        return $listAnswer;
    }



    private function filterAnswer($steps_data){
            echo test;
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



