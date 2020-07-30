<?php
namespace Kennziffer\KeQuestionnaire\ViewHelpers;
use Kennziffer\KeQuestionnaire\Domain\Model\Answer;
use Kennziffer\KeQuestionnaire\Domain\Model\Question;
use Kennziffer\KeQuestionnaire\Domain\Model\Result;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Kennziffer.com <info@kennziffer.com>, www.kennziffer.com
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * check if the question is answered
 *
 * @package ke_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CheckAnsweredQuestionViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * @var boolean
     */
    protected $escapeChildren = false;

    /**
     * @var boolean
     */
    protected $escapeOutput = false;

    /** * Constructor *
     * @api */
    public function initializeArguments() {
        $this->registerArgument('question', '\Kennziffer\KeQuestionnaire\Domain\Model\Question', ' The question ', true );
        $this->registerArgument('result', '\Kennziffer\KeQuestionnaire\Domain\Model\Result', 'the Result object  ', false );
        parent::initializeArguments() ;
    }

	/**
     * @return mixed The finally rendered child nodes.
	 */	 	
	public function render() {
	    /** @var Result $result */
        $result = $this->arguments['result'] ;
        /** @var Question $question */
        $question = $this->arguments['question'] ;

        /** @var Question $rQuestion */
        foreach ($result->getQuestions() as $rQuestion){
			if ($rQuestion->getQuestion() === $question){
			    /** @var Answer $rAnswer */
                foreach ($rQuestion->getAnswers() as $rAnswer){
					if ($rAnswer->getValue() != '') return $this->renderChildren();					
				}
			}
		}        
	}

}
?>