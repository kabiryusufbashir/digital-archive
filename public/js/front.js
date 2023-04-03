// Toggle button 
let menu = document.querySelector('#menu');
let nav = document.querySelector('#nav');

menu.addEventListener('click', ()=>{
    if(nav.classList.contains('hidden')){
        nav.classList.remove('hidden');
    }else{
        nav.classList.add('hidden');
    }
});

// Document Module 
let docNav = document.querySelector('#docNav')
let docBody = document.querySelector('#docBody')
let newDirectory = document.querySelector('#newDirectory')
let directory = document.querySelector('#directory')
let addDirectoryForm = document.querySelector('#addDirectoryForm')
let closeModalDirectory = document.querySelector('#closeModalDirectory')
let newDoc = document.querySelector('#newDoc')
let doc = document.querySelector('#doc')
let addDocForm = document.querySelector('#addDocForm')
let closeModalDoc = document.querySelector('#closeModalDoc')
    
    //Document Nav
    docNav.addEventListener('click', ()=>{
        if(docBody.classList.contains('hidden')){
            docBody.classList.remove('hidden')
        }else{
            docBody.classList.add('hidden')
        }
    })

    //New Directory 
    newDirectory.addEventListener('click', ()=>{
        directory.classList.remove('hidden')
        addDirectoryForm.classList.remove('hidden')
    })

    // Close Modal Directory
    closeModalDirectory.addEventListener('click', ()=>{
        directory.classList.add('hidden')
    })

    //New Document 
    newDoc.addEventListener('click', ()=>{
        doc.classList.remove('hidden')
        addDocForm.classList.remove('hidden')
    })

    // Close Modal 
    closeModalDoc.addEventListener('click', ()=>{
        doc.classList.add('hidden')
    })
    
//End of Document

//Profile Module
let profileNav = document.querySelector('#profileNav')
let profile = document.querySelector('#profile')
let profileForm = document.querySelector('#profileForm')
let closeModalProfile = document.querySelector('#closeModalProfile')

    // Profile Navigation 
    profileNav.addEventListener('click', ()=>{
        profile.classList.remove('hidden')
        profileForm.classList.remove('hidden')
    })

    // Close Modal 
    closeModalProfile.addEventListener('click', ()=>{
        profile.classList.add('hidden')
    })
