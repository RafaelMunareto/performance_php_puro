import state from "./state";

export default{

    getSelectFunc() {
        var getSelectFunc = state.func.map( select => {
            return{
                name: select.cod_func + " - " + select.nome ,
                id: select.cod_func
            }
        })
        return getSelectFunc;

    }

}

