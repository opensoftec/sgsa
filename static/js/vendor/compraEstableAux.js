
var app = {
    factura: {
        //cabecera
        proveedor: '', //esto tambien dice que es un objecto
        fecha: '',
        contado: '',
        subtotal: 0.0,
        descuento: 0.0,
        impuesto: 0.0,
        total: 0.0,
        usuId: 0,
        comprador: 0,
        proId: 0,
        aux : 0,
        items: []
    },
    add: function (item) {
        if (!this.existe(item)) {
            item.total = item.cantidad * item.precio;
            item.subtotal = item.total;
            this.factura.items.push(item);
        }
        this.listar();
        console.log(this.factura.items);
    },
    existe: function (item) {
        for (var i in this.factura.items) {
            if (item.codigo.toString() === this.factura.items[i].codigo.toString()) {
                this.factura.items[i].total += parseFloat(parseFloat(item.precio) * item.cantidad);
                this.factura.items[i].cantidad += parseInt(item.cantidad);
                return true;
            }
        }
        return false;
    },
    actualizar: function (item) {
        for (var i in this.factura.items) {
            if (item.codigo.toString() === this.factura.items[i].codigo.toString()) {
                this.factura.items[i].subtotal = parseFloat(this.factura.items[i].precio * item.cantidad);
                this.factura.items[i].cantidad = parseInt(item.cantidad);
                this.factura.items[i].descuentoLibras = (this.factura.items[i].descuentoPorcentaje/100)*this.factura.items[i].cantidad;
                this.factura.items[i].descuento = (this.factura.items[i].descuentoLibras*this.factura.items[i].precio);
                this.factura.items[i].total = this.factura.items[i].subtotal - this.factura.items[i].descuento;
                return true;
            }
        }
        return false;
    },
    actualizarDescuento: function (item) {
        for (var i in this.factura.items) {
            if (item.codigo.toString() === this.factura.items[i].codigo.toString()) {
                this.factura.items[i].descuentoPorcentaje = item.descuentoPorcentaje;
                this.factura.items[i].descuentoLibras = (this.factura.items[i].descuentoPorcentaje/100)*this.factura.items[i].cantidad;
                this.factura.items[i].descuento = (this.factura.items[i].descuentoLibras*this.factura.items[i].precio);
                this.factura.items[i].total = this.factura.items[i].subtotal - this.factura.items[i].descuento;
                return true;
            }
        }
        return false;
    },
    actualizarObservacion: function (item) {
        for (var i in this.factura.items) {
            if (item.codigo.toString() === this.factura.items[i].codigo.toString()) {
                this.factura.items[i].observacion = item.observacion;
                return true;
            }
        }
        return false;
    }
    ,
    editar: function (item) {

    },
    eliminar: function (codigo) {
        for (var i in this.factura.items) {
            if (codigo === this.factura.items[i].codigo) {
                this.factura.items.splice(i, 1);
                return true;
            }
        }
        return false;
    },
    listar: function () {
        //estoy borrando todos los tbody
        $('#id_tabla #id_det').html('');
        var subtotal = 0.0;

        for (var i in this.factura.items){
        var item = this.factura.items[i];
            var rw = '<tr class="fila_tbody">';
                rw += '<td>' + (parseInt(i)+1) + '</td>';
                rw += '<td>' + item.codigo + '</td>';
                rw += '<td>' + item.producto + '</td>';
                rw += '<td><input type="number" class="form-control actualizarCantidad" data-codigo="' + item.codigo + '" value="' + item.cantidad + '" min="1"></td>';
                
                rw += '<td><input type="number" class="form-control actualizarDescuento" data-codigo="' + item.codigo + '" value="' + item.descuentoPorcentaje + '" max="99" min="0"></td>';
                rw += '<td><input type="text" class="form-control cajaObservacion" data-codigo="'+item.codigo+'" value="'+item.observacion+'"></td>';
                rw += '<td><button class="btn btn-success actualizarObservacion"  data-codigo="'+item.codigo+'" type="button"><i class="glyphicon glyphicon-refresh"></i></button></td>';
                
                rw += '<td>' + item.precio + '</td>';
                
                rw += '<td>' + item.subtotal + '</td>';
                rw += '<td>' + item.descuentoLibras + '</td>';
                rw += '<td>' + (item.descuento).toFixed(2)+ '</td>';
                
                rw += '<td>' + item.total + '</td>';
                subtotal = parseFloat(subtotal) + parseFloat(item.total);
                rw += '<td class="text-center"><button value="' + item.codigo + '" type="button" class="btn btn-danger delete"><i class="glyphicon glyphicon-remove"></i>Eliminar</button></td>';
                rw += '</tr>';
            $('#id_tabla #id_det').append(rw);
        }
        $('#id_subtotal2').val((subtotal).toFixed(2));
        $('#id_descuento2').val((subtotal * this.factura.aux).toFixed(2));
        $('#id_impuesto2').val((subtotal * 0.00).toFixed(2));
        $('#id_total2').val((subtotal - (subtotal * this.factura.aux)).toFixed(2));
    }
};

//Delegado en jquery


