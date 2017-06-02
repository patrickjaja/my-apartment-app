class Api {
    constructor(options) {
        var defaults={
            'method' : 'GET',
            'mode' : 'cors',
            'params': { },
            'defaultParams': { },
            'responseFormat': 'json',
            'apiPath' : 'http://localhost/my-apartment/api/server.php'
        };
        this.configuration = Object.assign(defaults, options);
    }
    //overwrite default function functionality like handleError
    setFunction(func) {
        Object.assign(this.__proto__.__proto__,func);
    }
    setParams(params) {
        Object.assign(this.configuration.defaultParams,params);
    }
    call(params) {
        this.configuration.params = params;

        //set in child constructor className
        if (this.className) {
            this.configuration.params=Object.assign({}
                ,this.configuration.params
                ,{"class":this.className});
        }
        //Prep Uri Params
        var uriparams=Object.assign({}
            ,this.configuration.defaultParams
            ,this.configuration.params);

        var callMsg={}; //will be a promise

        if (this.configuration.method==="POST") {
            //HTTP POST
            var form = new FormData();
            for (var param in uriparams) {
                form.append(param, uriparams[param]);
            }
            callMsg = fetch(this.configuration.apiPath, {
                method: "POST",
                body: form
            });
        } else {
            //HTTP GET
            if (this.configuration.method==="GET") {
                var apiString=this.buildUrl(this.configuration.apiPath,uriparams);
                var myRequest = new Request(apiString);
                callMsg = fetch(myRequest);
            }
        }

        //Parse & validate Response
        var checkResponse = new Promise((reslove, reject)=> {
            callMsg
                .then(resp => resp.text())
                .then(responseText => this.parseResponse(responseText))
                .then(parsedResponse => {
                    var response = this.validateResponse(parsedResponse);
                    reslove(response);
                }).catch(err => {
                //reject on exception
                this.handleError(err);
                reject(err);
            });
        });
        return checkResponse;
    }
    parseResponse(responseText) {
        if (this.configuration.responseFormat == "json") {
            var responseObj=JSON.parse(responseText);
            return this.outputMessage(responseObj);
        }
        this.handleError("I dont know this format: "+this.configuration.responseFormat);
    }
    validateResponse(response) {
        //ToDo: More validation
        if (this.autoParse) {
            if (this.autoParse==true) {
                response=response.msg.content;
            }
        }
        return response;
    }
    outputMessage(msg) {
        return {msg:msg, configuration:this.configuration};
    }
    throwNoUser(error) {
        this.throwError(error);
    }
    throwError(error) {
        throw Error(error);
    }
    handleError(error) {
        return console.log("HIER EIN FEHLER:" + error);
    }
    e(error) {
        return this.handleError(error);
    }
    buildUrl(url, parameters) {
        var qs = "";
        for(var key in parameters) {
            var value = parameters[key];
            qs += encodeURIComponent(key) + "=" + encodeURIComponent(value) + "&";
        }
        if (qs.length > 0){
            qs = qs.substring(0, qs.length-1); //chop off last "&"
            url = url + "?" + qs;
        }
        this.url = url;
        return url;
    }
    //Auto defined Server functions (Pro tip: inherited automatically by extending class.api.php)
    load(params) {
        var uriparams=Object.assign({}
            ,{'func':'load'}
            ,params);
        return this.call(uriparams);
    }
    read(params) {
        var uriparams=Object.assign({}
            ,{'func':'read'}
            ,params);
        return this.call(uriparams);
    }
    update(params) {
        var uriparams=Object.assign({}
            ,{'func':'update'}
            ,params);
        return this.call(uriparams);
    }
    insert(params) {
        var uriparams=Object.assign({}
            ,{'func':'insert'}
            ,params);
        return this.call(uriparams);
    }
    delete(params) {
        var uriparams=Object.assign({}
            ,{'func':'delete'}
            ,params);
        return this.call(uriparams);
    }
    readAll(params) {
        var uriparams=Object.assign({}
            ,{'func':'readAll'}
            ,params);
        return this.call(uriparams);
    }
}