export default class Vincula {

    constructor(
                id='',
                cod_func='',
                nome_func='',
                cod_item='',
                nome_item='',
                categoria='',
                obj='',
                rlz=0,
                peso=0,
                pontos=0,
                perc=0,
                adm_id='',
                data=''
    ){
        this.id = id;
        this.cod_func = cod_func;
        this.nome_func = nome_func;
        this.cod_item = cod_item;
        this.nome_item = nome_item;
        this.categoria = categoria;
        this.obj = obj;
        this.rlz = rlz;
        this.peso = peso;
        this.pontos = pontos;
        this.perc = perc;
        this.adm_id = adm_id;
        this.data = data;
    }
}
