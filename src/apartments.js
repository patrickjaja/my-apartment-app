/**
 * Created by pschoen on 02.06.2017.
 */
class Apartments extends Api {
    constructor(options = {}) {
        if (!options.params) {
            options.params = {};
        }
        super(options);
        this.className="apartments";
        this.autoParse=true;
    }
}