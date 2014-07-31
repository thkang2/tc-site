// @TODO move to it's own module do it can be included in other module ie checkpoints, results, etc
// @TODO is the result from service.one(challengeType).one('challenges').one('result', id) cached?
// @TODO change to new API endpoints: http://api.topcoder.com/v2/challenges/30041860.  the type is no longer needed
// @TODO look to combine this service with the challenge already defined.
cdapp.factory('ChallengeService', ['Restangular', 'API_URL', '$q', '$cookies', '$window', function(Restangular, API_URL, $q, $cookies, $window) {

  var service = Restangular.withConfig(function(RestangularConfigurer) {
    
    RestangularConfigurer.setBaseUrl(API_URL);

    // request config
    //RestangularConfigurer.setDefaultHttpFields({'withCredentials': true});

    // tcjwt cookie
    //RestangularConfigurer.setDefaultHeaders({
    //  'Authorization': 'Bearer ' + $cookies.tcjwt
    //});
    
  });

  service.getResults = function(id) {
    var defer = $q.defer();
    service.one(challengeType).one('challenges').one('result', id).getList().then(function(results) {
      results = results[0];
      var submissionMap = {};
      var leftovers = []; // for those that got a score of 0
      results.results.map(function(x) {
        if (x.placement == 'n/a' || !x.placement) leftovers.push(x);
        submissionMap[x.placement] = x;
      });
      results.firstPlaceSubmission = submissionMap[1];
      results.secondPlaceSubmission = submissionMap[2];
      results.numSubmissions = results.submissions;
      results.submissions = [];
      var i = 1;
      while (submissionMap[i]) {
        results.submissions.push(submissionMap[i]);
        i++;
      }
      while (leftovers.length > 0) {
        results.submissions.push(leftovers.pop());
      }
      leftovers.reverse();
      results.initialScoreSum = 0;
      results.finalScoreSum = 0;
      results.submissions.map(function(x) {
        results.initialScoreSum += x.initialScore;
        results.finalScoreSum += x.finalScore;
      });
      defer.resolve(results);
    });
    return defer.promise;
  };

  service.getCheckpointData = function(id) {
    var defer = $q.defer();
    service.one(challengeType).one('challenges').one('checkpoint', id).getList().then(function(data) {
      data = data[0];
      if (data.error) defer.resolve(false);
      defer.resolve(data);
    });
    return defer.promise;
  };

  service.getChallenge = function(id) {
    var defer = $q.defer();
    //currently topcoder API server does not have CORS setup properly so we get a CORS error instead of proper error response when requesting an invalid challengeId
    //so we handle the CORS error with a redirect to 404 with an ErrorInterceptor
    service.setErrorInterceptor(function(response, deferred, responseHandler) {
      $window.location.href = '/404';
      return false;
    });
    service.one(challengeType).one('challenges').getList(id).then(function(challenge) {
      challenge = challenge[0];
      var submissionMap = {};
      challenge.submissions.map(function(submission) {
        if (submissionMap[submission.handle || submission.submitter]) {
          var neu = moment(submission.submissionDate || submission.submissionTime);
          var alt = moment(submissionMap[submission.handle || submission.submitter]);
          if (neu > alt) {
            submissionMap[submission.handle || submission.submitter] = submission.submissionDate || submission.submissionTime;
          }
        } else {
          submissionMap[submission.handle || submission.submitter] = submission.submissionDate || submission.submissionTime;
        }
      });

      challenge.registrants.map(function(x) {
        //initialize submissionStatus on all registrants
        x.submissionStatus = '';
      });
      //bugfix: refactored-challenge-details-68: copy submissionStatus here for all registered users last submissions into registrants object for easy access
      challenge.registrants.map(function(x) {
        challenge.submissions.map(function(y) {
          if (x.handle == y.handle && x.lastSubmissionDate == y.submissionDate) {
            x.submissionStatus = y.submissionStatus;
          }
        });
      });
      
      if (challenge.allowStockArt) {
        challenge.allowStockArt = challenge.allowStockArt == 'true';
      }

      challenge.submitDisabled = true;

      var handleMap = {};
      challenge.registrants.map(function(x) {
        handleMap[x.handle] = true;
      });

      defer.resolve(challenge);
    });
    return defer.promise;
  };

  return service;
}]);
