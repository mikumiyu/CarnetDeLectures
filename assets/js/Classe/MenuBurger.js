class MenuBurger{

    //le constructeur attend un tableau d'objet [{title,url},{title,url}]
    constructor(tab){
        this.content = tab;
    }

    createBurgerMenu(body){

        const currentBurger = document.querySelector(".burger-menu")

        if(!currentBurger){
            const burgerContainer = document.createElement('div')
            burgerContainer.classList.add('burger-menu')

            for(const link of this.content){

                const a = document.createElement("a")
                a.innerText = link.title;
                a.href = link.url
                burgerContainer.appendChild(a)

            }

            
            burgerContainer.classList.add('display-in')
            body.appendChild(burgerContainer)
            

            burgerContainer.addEventListener('mouseleave', ()=>{
                burgerContainer.classList.remove('display-in')
                burgerContainer.classList.add('display-out')
                setTimeout(()=>{
                    body.removeChild(burgerContainer);
                },300)
            })
        }

    }



}

export default MenuBurger;