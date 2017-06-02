/**
 * Created by pschoen on 02.06.2017.
 */
var MyApartment = function () {
    //Configurations
    var defaults = {
        'method': 'GET',
        'mode': 'cors',
        'apiPath': 'http://localhost/my-apartment/api/server.php'
    };
    this.api = new Api(defaults);
    this.apartments = new Apartments(defaults);
    this.token = new Token(defaults);
};
var app = new MyApartment();