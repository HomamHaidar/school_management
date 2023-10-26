<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ShowQuestion extends Component
{
    public $student_id, $quizze_id, $data, $counter = 0, $question_conut;

    public function nextQuestion($question_id, $score, $right_answer, $answer)
    {


        $stDegree = Degree::where('student_id', $this->student_id)->where('quizze_id', $this->quizze_id)->first();

        if ($stDegree == null) {

            $degree = new Degree();
            $degree->quizze_id = $this->quizze_id;

            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;

            if (strcmp(trim($answer), trim($right_answer)) === 0) {
                $degree->score += $score;
            } else {
                $degree->score += 0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();

        } else {
            if ($stDegree->question_id >= $this->data[$this->counter]->id) {
                $stDegree->score = 0;
                $stDegree->abuse = '1';
                $stDegree->save();
                noty()->addError(trans('Students_trans.Fraud'));
                return redirect()->route('student_exam.index');

            } else {
                $stDegree->question_id = $question_id;
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $stDegree->score += $score;
                } else {
                    $stDegree->score += 0;
                }

                $stDegree->save();
            }
        }
        if ($this->counter < $this->question_conut - 1) {
            $this->counter++;
        } else {
            noty()->addSuccess(trans('Students_trans.quizz_done'));
            return redirect()->route('student_exam.index');
        }
    }

    public function render()

    {

        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        $this->question_conut = $this->data->count();
        return view('livewire.show-question', ['data']);
    }

}
