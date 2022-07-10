

var app = {
    factura : {
        //cabecera
        proveedor : '',//esto tambien dice que es un objecto
        fecha : '',
        contado : '',
        subtotal : 0.0,
        descuento : 0.0,       
        impuesto : 0.0,
        total : 0.0,
        usuId : 0,
        comprador : 0,
        proId : 0,
        items : []
    },
    add : function(item){
        if(!this.existe(item)){
            item.total = item.cantidad * item.precio;
            this.factura.items.push(item);
        }
        this.listar();
        console.log(this.factura.items);
    },
    existe : function (item){
       
        for(var i in this.factura.items){
            if(item.codigo.toString() === this.factura.items[i].codigo.toString()){
                this.factura.items[i].total += parseFloat(parseFloat(item.precio) * item.cantidad);
                this.factura.items[i].cantidad += parseInt(item.cantidad);
                return true;
            }
        }
        return false;
    },
    actualizar : function (item){
        for(var i in this.factura.items){
            if(item.codigo.toString() === this.factura.items[i].codigo.toString()){
                 this.factura.items[i].total = parseFloat(this.factura.items[i].precio * item.cantidad);
                 this.factura.items[i].cantidad = parseInt(item.cantidad);
                 return true;
            }
        }
        return false;
    },
    editar : function (item){
        
    },
    eliminar : function (codigo){
        for(var i in this.factura.items){
            if(codigo === this.factura.items[i].codigo){
                 this.factura.items.splice(i,1);
                 return true;
            }
        }
        return false;
    },
    listar : function(){
        //estoy borrando todos los tbody
        $('#id_tabla #id_det').html('');
        var subtotal = 0.0;
        
        for(var i in this.factura.items){
            var item = this.factura.items[i];
           
            var rw = '<tr class="fila_tbody">';
                rw += '<td>'+(i+1)+'</td>';
                rw += '<td>'+item.codigo+'</td>';
                rw += '<td>'+item.producto+'</td>';
                rw += '<td><input type="number" class="form-control actualizar" data-codigo="'+item.codigo+'" value="'+item.cantidad+'" max="'+item.stock+'" min="1"></td>';
                rw += '<td><input type="number" class="form-control actualizar" data-codigo="'+item.codigo+'" value="'+item.cantidad+'" max="'+item.stock+'" min="1"></td>';
                rw += '<td>'+item.precio+'</td>';
                rw += '<td>'+item.total+'</td>';
                subtotal = parseFloat(subtotal) + parseFloat(item.total);
                rw += '<td class="text-center"><button value="'+item.codigo+'" type="button" class="btn btn-danger delete"><i class="glyphicon glyphicon-remove"></i>Eliminar</button></td>';
            rw += '</tr>';
            $('#id_tabla #id_det').append(rw);
        }
        $('#id_subtotal2').val((subtotal).toFixed(2));
        $('#id_impuesto2').val((subtotal*0.14).toFixed(2));
        $('#id_total2').val((subtotal+(subtotal*0.14)).toFixed(2));
    }
};
