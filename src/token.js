/**
 * Created by pschoen on 02.06.2017.
 */
class Token extends Api {
    constructor(options = {}) {
        if (!options.params) {
            options.params = {};
        }
        super(options);
        this.className="token";
        this.autoParse=true;
    }
}