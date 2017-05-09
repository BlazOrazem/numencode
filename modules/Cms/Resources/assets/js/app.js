
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

$(document).ready(function() {

    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example', require('./components/Example.vue'));
//
//const app = new Vue({
//    el: '#app'
//});

//var SampleModule = (function () {
//    // Let's initialize a public variable
//    var sampleVariable = 42;
//
//    // We can operate with public variables
//    sampleVariable *= 2.0;
//
//    // This is a private method
//    var _doSomethingPrivately = function () {
//        // We can use public variables in the private method
//        var privateVariable = sampleVariable * 2;
//        console.log('Private variable: ' + privateVariable);
//
//
//        // Use function.apply to pass the called parameters along
//        //GoogleAnalytics.pushOrSomething.apply(this, arguments);
//    };
//
//    var simplePublicMethod = function () {
//        _doSomethingPrivately('simple_action');
//    };
//
//    var publicMethod = function (sampleVariable) {
//        _doSomethingPrivately('action', sampleVariable);
//    };
//
//    var getSampleVariable = function () {
//        return sampleVariable;
//    };
//
//    return {
//        sampleVariable: sampleVariable,
//        simplePublicMethod: simplePublicMethod,
//        getSampleVariable: getSampleVariable,
//        publicMethod: publicMethod
//    };
//})();

// Let's call our variables and methods
//console.log('Public variable: ' + SampleModule.sampleVariable);
//console.log('Public variable getter: ' + SampleModule.getSampleVariable());