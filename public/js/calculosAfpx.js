function calcularMonto(cantidad, valorCuota) {
    let total;

    total = parseFloat(valorCuota) * parseFloat(cantidad);
    console.log(total, cantidad, valorCuota, total.toFixed(3));
    return total.toFixed(3);
}

function calcularCuota(monto, valorCuota) {
    let total;

    total = parseFloat(monto) / parseFloat(valorCuota);
    console.log(total, monto, valorCuota);
    return total.toFixed(2);
}


