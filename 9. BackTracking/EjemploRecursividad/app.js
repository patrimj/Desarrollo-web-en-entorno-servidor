const factorial = (n) => {
    if (n == 0) {
        return 1;
    } else {
        return n * factorial(n - 1);
    }
}

console.log(factorial(5));

const fibonacci = (n) => {
    if (n == 0) {
        return 0;
    } else if (n == 1) {
        return 1;
    } else {
        return fibonacci(n - 1) + fibonacci(n - 2);
    }
}

console.log(fibonacci(25));

const buscarArray = (a, e, i) => {
    if (i == a.length) {
        return -1;
    } else if (a[i] == e) {
        return i;
    } else {
        return buscarArray(a, e, i + 1);
    }
}

let arr = [1,2,6,8,9]
console.log(buscarArray(arr,2,0));

const potencial = (n) => {
    if (n == 0) {
        return 1;
    } else {
        return 2 * potencial(n - 1);
    }
}

console.log(potencial(3))

const elevador = (b, e) => {
    if (e == 0) {
        return 1;
    } else {
        return b * elevador(b, e - 1);
    }
}

console.log (elevador(3,4))