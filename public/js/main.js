const menuOpen = document.getElementById("openMenu")
const menuClose = document.getElementById("closeMenu")
const menu =document.querySelector(".menu")
const sectionRight=document.querySelector('.section-right')

menuOpen.addEventListener("click",function(){
    menuOpen.classList.add("d-none")
    menu.classList.add("menu-left")
    sectionRight.classList.add("section-width")
    
})
menuClose.addEventListener("click",function(){
    menuOpen.classList.remove("d-none")
    menu.classList.remove("menu-left")
    sectionRight.classList.remove("section-width")
    
})

const menuListCollapsed = document.querySelectorAll(".menu-list-collapsed")

menuListCollapsed.forEach(function(item){
    const submenuList = item.querySelector('.submenu-list')
    item.addEventListener("click",function(){
        menuListCollapsed.forEach(function(items){
            const submenu = items.querySelector('.submenu-list')
            if(item != items){
                items.classList.remove("active-item")
                submenu.classList.remove("show")
            }
        })
        submenuList.classList.toggle("show")
        item.classList.toggle("active-item")

     })
    })

const dropdownOpen = document.querySelectorAll(".dropdown-open")
const menuDropAll = document.querySelectorAll(".menu-dropdown")

dropdownOpen.forEach(function(item){
    item.addEventListener("click",function(event){
        const menuDropDown = item.querySelector(".menu-dropdown")
        if(!menuDropDown.contains(event.target)){
            menuDropAll.forEach(function(dropdownItems){
                if(menuDropDown != dropdownItems){
                    dropdownItems.classList.add("d-none")
                }
            })
            menuDropDown.classList.toggle("d-none")
        }
        event.stopPropagation();
    })
})
document.addEventListener("click",function(event){
        menuDropAll.forEach(function(Items){
            if(!Items.contains(event.target)){
                Items.classList.add("d-none")
            }
    })
})

let imageInput= document.querySelectorAll(".image-input")
let file;
imageInput.forEach(function(items){
    let button = items.querySelector('.button')
    let input = items.querySelector("input")
   button.onclick =()=>{
        input.click();
    }
})


