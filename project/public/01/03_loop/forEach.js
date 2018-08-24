members.forEach (function(prod) {
    Object.keys(prod).forEach (function(key) {
        console.log(key + " : " + prod[key]);
    })
})