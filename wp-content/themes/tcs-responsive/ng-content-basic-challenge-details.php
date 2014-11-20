<div class="container">
<header class="pageHeading aboutPage">
  <h1 ng-bind="CD.challenge.challengeName"></h1>

  <h2>CHALLENGE TYPE: <span ng-bind="CD.challenge.challengeType"></span></h2>
</header>

<div id="stepBox">
<div class="container">

<div class="leftColumn">
    <a ng-show="!CD.isDesign" ng-click="CD.registerToChallenge()" ng-class="{disabled:CD.challenge.registrationDisabled || !CD.callComplete, disabledNOT:!CD.challenge.registrationDisabled}" class="btn btnAction challengeRegisterBtn" href="javascript:;">
        <span>1</span><strong>Register For This Challenge</strong>
    </a>
    <a ng-show="!CD.isDesign" ng-class="{disabled:CD.challenge.submissionDisabled || !CD.callComplete, disabledNOT:!CD.challenge.submissionDisabled}" class="btn btnAction" target="_blank"
       ng-href="/challenge-details/{{CD.challenge.challengeId}}/submit/?type=develop&lc={{CD.isLC}}">
        <span>2</span><strong>Submit Your Entries</strong>
    </a>
    <a ng-show="CD.isDesign" ng-click="CD.registerToChallenge()" ng-class="{disabled:CD.challenge.registrationDisabled || !CD.callComplete, disabledNOT:!CD.challenge.registrationDisabled}" class="btn btnAction challengeRegisterBtn" href="javascript:;">
        <span>1</span> <strong>Register For This Challenge</strong>
    </a>
    <a ng-show="CD.isDesign" ng-class="{disabled:CD.challenge.submissionDisabled || !CD.callComplete, disabledNOT:!CD.challenge.submissionDisabled}" class="btn btnAction" target="_blank"
       ng-href="http://studio.topcoder.com/?module=ViewRegistration&ct={{CD.challenge.challengeId}}">
        <span>2</span> <strong>Submit Your Entries</strong>
    </a>
    <a ng-show="CD.isDesign" ng-class="{disabled:CD.challenge.submissionDisabled || !CD.callComplete, disabledNOT:!CD.challenge.submissionDisabled}" class="btn btnAction" target="_blank"
       href="http://studio.topcoder.com/?module=ViewSubmission&ct={{CD.challenge.challengeId}}">
        <span>3</span> <strong>View Your Submission</strong>
    </a>
</div>
<div class="middleColumn {{CD.isDesign ? 'studio' : ''}}">
<table class="prizeTable">
<tbody>

<tr>
    <td ng-if="!CD.isDesign && CD.challenge.challengeType != 'Code'" class="fifty">
      <h2>1st PLACE</h2>

      <h3>
        <small>$</small><span ng-bind="CD.challenge.prize ? (CD.challenge.prize[0] ? CD.challenge.prize[0] : '') : ''"></span>
      </h3>
    </td>
    <td ng-if="!CD.isDesign && CD.challenge.challengeType != 'Code'" class="fifty">
      <h2>2nd PLACE</h2>
      <h3>
        <small>$</small><span ng-bind="CD.challenge.prize ? (CD.challenge.prize[1] ? CD.challenge.prize[1] : '0') : ''"></span>
      </h3>
    </td>
      <td ng-if="(designOrCode = CD.isDesign || CD.challenge.challengeType == 'Code')" class="twenty {{!(CD.challenge.prize && CD.challenge.prize[0]) ? 'noPrize' : ''}}">
        <h2>1st PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="(CD.challenge.prize && CD.challenge.prize[0]) || 0"></span></h3>
      </td>
      <td ng-if="designOrCode" class="twenty {{!(CD.challenge.prize && CD.challenge.prize[1]) ? 'noPrize' : ''}}">
        <h2>2nd PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="(CD.challenge.prize && CD.challenge.prize[1]) || 0"></span></h3>
      </td>
      <td ng-if="designOrCode" class="twenty {{!(CD.challenge.prize && CD.challenge.prize[2]) ? 'noPrize' : ''}}">
        <h2>3rd PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="(CD.challenge.prize && CD.challenge.prize[2]) || 0"></span></h3>
      </td>
      <td ng-if="designOrCode" class="twenty {{!(CD.challenge.prize && CD.challenge.prize[3]) ? 'noPrize' : ''}}">
        <h2>4th PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="(CD.challenge.prize && CD.challenge.prize[3]) || 0"></span></h3>
      </td>
      <td ng-if="designOrCode" class="twenty {{!(CD.challenge.prize && CD.challenge.prize[4]) ? 'noPrize' : ''}}">
        <h2>5th PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="(CD.challenge.prize && CD.challenge.prize[4]) || 0"></span></h3>
      </td>
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize.length > 5)" class="morePayments active closed" rowspan="2">
      </td>
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize.length <= 5)" class="morePayments inactive" rowspan="2">
      </td>
</tr>
<tr ng-if="CD.challenge.prize  && CD.challenge.prize.length > 5 && (currentPlace = 6)" class="additionalPrizes hide" ng-repeat="i in range(0, (CD.challenge.prize.length - 5) / 5)">
  <td class="twenty" ng-if="CD.challenge.prize.length > 5 + i * 5" ng-repeat="j in range(i * 5, max((i + 1) * 5), CD.challenge.prize.length)">
    <h2 ng-bind-template="{{j + 1}}'th PLACE'"></h2>
    <h3><small>$</small><span ng-bind="CD.challenge.prize[j]"></span></h3>
  </td>
</tr>
<tr><!-- Bugfix: Added noPrize class when challenge has no reliability bonus -->
    <td ng-if="!CD.isDesign" colspan="{{CD.challenge.challengeType == 'Code' ? '2' : ''}}" class="{{ (!CD.challenge.reliabilityBonus || CD.challenge.challengeType === 'Bug Hunt') ? 'noPrize' : ''}}">
      <p class="realibilityPara">
        Reliability Bonus
        <span ng-if="CD.reliabilityBonus && CD.challenge.challengeType !== 'Bug Hunt'" ng-bind-template="${{CD.challenge.reliabilityBonus}}">
        </span>
        <span ng-if="!(CD.reliabilityBonus) || CD.challenge.challengeType === 'Bug Hunt'">
          N/A
        </span>
      </p>
    </td><!-- Bugfix: Added noPrize class when challenge has no DR points -->
    <td ng-if="!CD.isDesign" colspan="{{CD.challenge.challengeType == 'Code' ? '3' : ''}}" class="{{!CD.challenge.digitalRunPoints ? 'noPrize' : ''}}">
      <p class="drPointsPara">DR Points <span ng-bind="CD.challenge.digitalRunPoints ? CD.challenge.digitalRunPoints : 'N/A'"></span></p>
    </td>
    </td>
    <td ng-if="CD.isDesign" colspan="2">
        <p class="scPoints"><span ng-bind="CD.challenge.digitalRunPoints ? CD.challenge.digitalRunPoints : ''"></span>{{!CD.challenge.digitalRunPoints ? 'NO' : ''}} STUDIO CUP POINTS</p>
    </td>
    <td ng-if="CD.isDesign" colspan="3">
      <p class="scPoints" ng-if="CD.challenge.numberOfCheckpointsPrizes > 0"><span ng-bind="CD.challenge.numberOfCheckpointsPrizes"></span> CHECKPOINT AWARDS WORTH <span ng-bind-template="${{CD.challenge.topCheckPointPrize}}"></span>
        EACH</p>
      <p class="scPoints" ng-if="CD.challenge.numberOfCheckpointsPrizes == 0">NO CHECKPOINT AWARDS</p>
    </td>
</tr>
</tbody>
</table>
<!-- TODO: not sure why this code is repeated -- probably get rid of it (or make sure my fix of it is correct) -->
<div class="prizeSlider hide">
  <ul>
    <li class="slide">
      <table>
        <tbody>

<tr>
    <td ng-if="!CD.isDesign && CD.challenge.challengeType != 'Code'" class="fifty">
      <h2>1st PLACE</h2>

      <h3>
        <small>$</small><span ng-bind="CD.challenge.prize ? (CD.challenge.prize[0] ? CD.challenge.prize[0] : '') : ''"></span>
      </h3>
    </td>
    <td ng-if="!CD.isDesign && CD.challenge.challengeType != 'Code'" class="fifty">
      <h2>2nd PLACE</h2>
      <h3>
        <small>$</small><span ng-bind="CD.challenge.prize ? (CD.challenge.prize[1] ? CD.challenge.prize[1] : '0') : ''"></span>
      </h3>
    </td>
      <td ng-if="(designOrCode = CD.isDesign || CD.challenge.challengeType == 'Code') && (CD.challenge.prize && CD.challenge.prize[0])" class="twenty">
        <h2>1st PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="CD.challenge.prize[0]"></span></h3>
      </td>
      <td ng-if="designOrCode && !(CD.challenge.prize && CD.challenge.prize[0])" class="twenty noPrize">
        <h2>1st PLACE</h2>

        <h3>
          <small>$</small>0</h3>
      </td>
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize[1])" class="twenty">
        <h2>2nd PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="CD.challenge.prize[1]"></span></h3>
      </td>
      <td ng-if="designOrCode && !(CD.challenge.prize && CD.challenge.prize[1])" class="twenty noPrize">
        <h2>2nd PLACE</h2>

        <h3>
          <small>$</small>0</h3>
      </td>
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize[2])" class="twenty">
        <h2>3rd PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="CD.challenge.prize[2]"></span></h3>
      </td>
      <td ng-if="designOrCode && !(CD.challenge.prize && CD.challenge.prize[2])" class="twenty noPrize">
        <h2>3rd PLACE</h2>

        <h3>
          <small>$</small>0</h3>
      </td>
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize[3])" class="twenty">
        <h2>4th PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="CD.challenge.prize[3]"></span></h3>
      </td>
      <td ng-if="designOrCode && !(CD.challenge.prize && CD.challenge.prize[3])" class="twenty noPrize">
        <h2>4th PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="CD.challenge.prize[3]"></span></h3>
      </td>
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize[4])" class="twenty">
        <h2>5th PLACE</h2>

        <h3>
          <small>$</small><span ng-bind="CD.challenge.prize[4]"></span></h3>
      </td>
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize[5])" class="twenty noPrize">
        <h2>5th PLACE</h2>

        <h3>
          <small>$</small>0</h3>
      </td>
      <!-- previously used rowspan logic might be needed: {{2 + ((CD.challenge.prize.length - 5) / 5)}} -->
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize.length > 5)" class="morePayments active closed" rowspan="2">
      </td>
      <td ng-if="designOrCode && (CD.challenge.prize && CD.challenge.prize.length <= 5)" class="morePayments inactive" rowspan="2">
      </td>
</tr>
<tr ng-if="CD.challenge.prize  && CD.challenge.prize.length > 5 && (currentPlace = 6)" class="additionalPrizes hide" ng-repeat="i in range(0, (CD.challenge.prize.length - 5) / 5)">
  <td class="twenty" ng-if="CD.challenge.prize.length > 5 + i * 5" ng-repeat="j in range(i * 5, max((i + 1) * 5), CD.challenge.prize.length)">
    <h2 ng-bind-template="{{j + 1}}'th PLACE'"></h2>
    <h3><small>$</small><span ng-bind="CD.challenge.prize[j]"></span></h3>
  </td>
</tr>
<tr>
    <td ng-if="!CD.isDesign" colspan="{{CD.challenge.challengeType == 'Code' ? '2' : ''}}">
      <p class="realibilityPara">
        Reliability Bonus
        <span ng-if="CD.reliabilityBonus && CD.reliabilityBonus.length > 0">
          {{CD.challenge.reliabilityBonus}}
        </span>
        <span ng-if="!(CD.reliabilityBonus && CD.reliabilityBonus.length > 0)">
          N/A
        </span>
      </p>
    </td>
    <td ng-if="!CD.isDesign" colspan="{{CD.challenge.challengeType == 'Code' ? '3' : ''}}">
      <p class="drPointsPara">DR Points <span ng-bind="CD.challenge.digitalRunPoints ? CD.challenge.digitalRunPoints : 'N/A'"></span></p>
    </td>
    </td>
    <td ng-if="CD.isDesign" colspan="2">
        <p class="scPoints"><span ng-bind="CD.challenge.digitalRunPoints ? CD.challenge.digitalRunPoints : 'NO'"></span> STUDIO CUP POINTS</p>
    </td>
    <td ng-if="CD.isDesign" colspan="3">
      <p class="scPoints"><span ng-bind="CD.challenge.numberOfCheckpointsPrizes"></span> CHECKPOINT AWARDS WORTH $<span ng-bind="CD.challenge.topCheckPointPrize"></span>
        EACH</p>
    </td>
</tr>        </tbody>
    </table>
  </div>
</div>
</div>

<div class="rightColumn">

  <div class="nextBox" ng-init="toggleAllNext = true;">

    <div class="nextBoxContent nextDeadlineNextBoxContent"  ng-show="toggleAllNext">
      <div class="icoTime">
        <span class="nextDTitle">Current Phase</span>
        <!-- Bugfix I-106745: if current status of contest is not Active, output current contest status, else output current contest phase if active. -->
        <span
          class="CEDate" ng-bind="CD.challenge.currentStatus.indexOf('Active') < 0 ? CD.challenge.currentStatus : CD.challenge.currentPhaseName"></span>
      </div>
      <!-- Bugfix I-106745: Added check for cancelled contest before display of current phase remaining time -->
      <span ng-if="CD.challenge.currentStatus != 'Completed' && CD.challenge.currentStatus != 'Deleted' && CD.challenge.currentStatus.indexOf('Cancelled') < 0 && CD.challenge.currentPhaseRemainingTime > 0" class="timeLeft">
        <span ng-bind="CD.challenge.currentPhaseRemainingTime | daysLeft"></span>
        <small><ng-pluralize count="CD.challenge.currentPhaseRemainingTime | daysLeft" when="{'1': 'Day', 'other': 'Days'}"/></small>
        <span ng-bind="CD.challenge.currentPhaseRemainingTime | hoursLeft"></span>
        <small><ng-pluralize count="CD.challenge.currentPhaseRemainingTime | hoursLeft" when="{'1': 'Hour', 'other': 'Hours'}"/></small>
        <span ng-bind="CD.challenge.currentPhaseRemainingTime | minsLeft"></span>
        <small><ng-pluralize count="CD.challenge.currentPhaseRemainingTime | minsLeft" when="{'1': 'Min', 'other': 'Mins'}"/></small>
      </span>
    </div>
    <!--End nextBoxContent-->
    <div ng-if="!CD.isDesign" class="nextBoxContent allDeadlineNextBoxContent ng-hide" ng-show="!toggleAllNext">
      <p><label>Start Date:</label>
        <span>
         {{CD.challenge.postingDate | formatDate:2}}
        </span>
      </p>
      <p><label>Register By:</label>
       <span>
         {{CD.challenge.registrationEndDate | formatDate:2}}
       </span>
      </p>
      <p class="{{CD.challenge.finalFixEndDate ? '' : 'last'"><label>Submit By:</label>
        <span>
          {{CD.challenge.submissionEndDate | formatDate:2}}
        </span>
      </p>

      <p ng-if="CD.challenge.finalFixEndDate" class="{{CD.challenge.finalFixEndDate ? 'last' : ''"><label>Final Submission:</label>
        <span>
          {{CD.challenge.finalFixEndDate | formatDate:2}}
        </span>
      </p>

    </div>
    <!--End nextBoxContent-->
    <div ng-if="CD.isDesign" class="nextBoxContent allDeadlineNextBoxContent studio ng-hide" ng-show="!toggleAllNext">
      <p><label>Start Date:</label>
        <span>
          {{CD.challenge.postingDate | formatDate:2}}
        </span>
      </p>
      <p ng-if="CD.challenge.checkpointSubmissionEndDate != ''"><label>Checkpoint:</label>
        <span>
          {{CD.challenge.checkpointSubmissionEndDate | formatDate:2}}
        </span>
      </p>

      <p><label>End Date:</label>
        <span>
          {{CD.challenge.submissionEndDate | formatDate:2}}
        </span>
      </p>

      <p class="last"><label>Winners Announced:</label>
        <span>
          {{CD.challenge.appealsEndDate  | formatDate:2}}
        </span>
      </p>
    </div>
    <!--End nextBoxContent-->
  </div>

  <!--End nextBox-->
  <div class="deadlineBox">

    <div class="deadlineBoxContent nextDeadlinedeadlineBoxContent" ng-show="toggleAllNext">
      <a class="viewAllDeadLineBtn" ng-click="toggleAllNext = !toggleAllNext">View all deadlines +</a>
    </div>
    <!--End deadlineBoxContent-->
    <div class="deadlineBoxContent allDeadlinedeadlineBoxContent ng-hide" ng-show="!toggleAllNext">
      <a class="viewNextDeadLineBtn" ng-click="toggleAllNext = !toggleAllNext">View next deadline +</a>
    </div>
    <!--End deadlineBoxContent-->
  </div>
  <!--End deadlineBox-->
</div>

</div>
</div>
<!-- /#hero -->

</div>
<!-- /.pageHeading -->