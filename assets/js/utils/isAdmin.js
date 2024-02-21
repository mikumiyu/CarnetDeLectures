export default async function isAdmin() {
    try {
      const response = await fetch('http://localhost/Projet%20final/backend/index.php?action=isAdmin');
      const data = await response.json();
      return data.isAdmin;
    } catch (error) {
      console.error('Erreur lors de la récupération du statut de l\'utilisateur :', error);
      throw error;
    }
  }
