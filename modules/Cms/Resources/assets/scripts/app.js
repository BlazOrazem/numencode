var SampleModule = (function () {
    // Let's initialize a public variable
    var sampleVariable = 42;

    // We can operate with public variables
    sampleVariable *= 2.0;

    // This is a private method
    var _doSomethingPrivately = function () {
        // We can use public variables in the private method
        var privateVariable = sampleVariable * 2;
        console.log('Private variable: ' + privateVariable);


        // Use function.apply to pass the called parameters along
        //GoogleAnalytics.pushOrSomething.apply(this, arguments);
    };

    var simplePublicMethod = function () {
        _doSomethingPrivately('simple_action');
    };

    var publicMethod = function (sampleVariable) {
        _doSomethingPrivately('action', sampleVariable);
    };

    var getSampleVariable = function () {
        return sampleVariable;
    };

    return {
        sampleVariable: sampleVariable,
        simplePublicMethod: simplePublicMethod,
        getSampleVariable: getSampleVariable,
        publicMethod: publicMethod
    };
})();

// Let's call our variables and methods
//console.log('Public variable: ' + SampleModule.sampleVariable);
//console.log('Public variable getter: ' + SampleModule.getSampleVariable());