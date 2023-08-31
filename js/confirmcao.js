const links = document.querySelectorAll(".apaga")

for(const link of links){
    link.addEventListener("click", function(event){
        event.preventDefault()
        let resposta = confirm("deseja excluir?")
        if(resposta){
            location.href = this.href
        }
    })   
}