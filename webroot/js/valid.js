$(document).ready(function() {
    $('#form').validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 15,
            },
            
            email: {
                required: true,
                email: true
            },
            address: {
                required: true,

            },
            
            phone: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 12
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 35,
            },
           
        },
        messages: {
           name: {
                required: "Please Enter your name",
                minlength: "not more then 2 chracter",
                maxlength: "not more then 12 chracter",
            },
           
            password: {
                required: "Please Enter your password",
                minlength: "your password must consist atleast 6 character"
            },
            
            email: {
                required: "Please Enter your Email Id"
            },
            contact: {


            },
            address: {
                required: "Please provide address",

            },
            phone: {
                required: "Enter your phone number",
                number: "Only numeric values are allowed",
                minlength: "not more then 12 digit",
                maxlength: "not more then 12 digit"
            },
           
        }
    });
});