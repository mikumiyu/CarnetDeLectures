import Comment from "./Classe/Comment.js";
import MenuBurger from './Classe/MenuBurger.js'
import isAdmin from './utils/isAdmin.js';


const comment = new Comment();

async function initMenu(){

    const isAdminResult = await isAdmin();

    const menuBurger = new MenuBurger(isAdminResult ? 
                                [
                                    {title:"Panneau administrateur",
                                    url:'./index.php?action=adminPannel'},
                                    {title:"Se déconnecter",
                                    url:"./index.php?action=disconnect"}
                                ] 
                                : 
                                [
                                    {title:"Se déconnecter",
                                    url:"./index.php?action=disconnect"}
                                ],
                                )
    return menuBurger;
}

let menuBurger;

initMenu().then(data => { menuBurger = data;});

document.addEventListener('DOMContentLoaded',()=>{

    const body = document.querySelector('body')
    
    
    if(document.getElementById('connectedBurgerLink')){

        const burgerMenuBtn = document.getElementById('connectedBurgerLink')
        
        burgerMenuBtn.addEventListener('mouseover',()=>{
    
            menuBurger.createBurgerMenu(body);
    
        })
    }

    
    

    


    if (window.location.href.includes('articlePage')) {

        let userId = document.getElementById('connectedBurgerLink').getAttribute('data-user-id')
        let bookId = document.getElementById('bookSection').getAttribute('data-book-id');
        const submitCommentBtn = document.getElementById('submitCommentFormBtn')
        let commentContentInput = document.getElementById('newCommentContent')

        comment.getCommentsByBookId(bookId)

        submitCommentBtn.addEventListener("click",e=>{
            e.preventDefault();
            let commentContent = commentContentInput.value

            comment.newComment(userId,commentContent,bookId).then(comment.getCommentsByBookId(bookId))

            commentContentInput.value = ""
        })

      }


})