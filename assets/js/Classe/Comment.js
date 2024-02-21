

class Comment{

    constructor() {
        this.user = "";
        this.date = "";
        this.commentContent = "";
        this.bookId = "";
    }

    getCommentsByBookId(bookId){
        

        fetch("./index.php?action=getCommentsAJAX", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: "id="+encodeURIComponent(bookId)
        })
            .then(response=>{
                if(!response.ok) {
                    throw new Error("La requete a échoué avec le statut : " + response.status);
                }
            
            
                return response.json();
            })
            .then(data=>{
                const commentDiv = document.querySelector('#comments')
                this.resetContainer(commentDiv)
                
                const comments = data[0]
                for(const comment of comments){
                    createCommentArticle(comment,commentDiv)
                }
            })
            .catch(error=>{console.error("Une erreur est survenue lors de la requete : "+error);});

            function createCommentArticle(commentData,commentDiv){
                const article = document.createElement('article')
                article.classList.add('commentCard')
                article.setAttribute('data-comment-id',commentData.comment_id)

                const userName = document.createElement('h4')
                userName.innerText = commentData.userName

                const commentContent = document.createElement('p')
                commentContent.innerText = commentData.commentContent

                article.appendChild(userName)
                article.appendChild(commentContent)

                commentDiv.appendChild(article)
            }
    }
    
    newComment(userId, commentContent, bookId) {
    
        const commentData = {
            commentContent: commentContent,
            userId: userId,
            bookId: bookId,
        };
    
        return fetch("./index.php?action=addCommentAJAX", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ commentData: commentData })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Réponse du serveur non OK');
            }
            return response.json();
        })
        .then(data => {
            // Traitement des données retournées par le serveur en cas de succès
            console.log('Réponse du serveur :', data);
        })
        .catch(error => {
            console.error('Erreur lors de la requête :', error);
            
        });
    }

    resetContainer(container){
        while(container.firstChild){
            container.removeChild(container.firstChild)
        }
    }
    

}

export default Comment;