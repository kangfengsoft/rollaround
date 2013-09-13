var BASE_PATH = "/" + window.location.pathname.split("/")[1];

function cloneObject(obj){
    if (obj === null){
        return null; 
    }
    var o = obj.constructor === Array ? [] : {};
    for(var i in obj){
        if(obj.hasOwnProperty(i)){
            o[i] = typeof obj[i] === "object" ? cloneObject(obj[i]) : obj[i];
        }
    }
    return o;
}