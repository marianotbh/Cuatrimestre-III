/* declaracion de funciones */
var callback = function hacerAlgo() {
    console.log("hice algo");
};

function sumar(num1, num2, funcion) {
    console.log(num1 + num2);
    funcion();
}

sumar(1, 5, callback);
