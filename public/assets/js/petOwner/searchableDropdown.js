document.addEventListener('DOMContentLoaded', function() {

    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = './assets/css/petOwner/searchableDropdown.css';
    document.head.appendChild(link);

});

class SearchableDropdown {
    constructor(config) {
        this.items = config.items || [];
        this.inputElement = config.inputElement;
        this.listElement = config.listElement;
        
        this.initialize();
    }
  
    initialize() {
        this.inputElement.addEventListener('input', (e) => this.filterItems(e.target.value));
        
        document.addEventListener('click', (e) => {
            if (!this.inputElement.contains(e.target) && !this.listElement.contains(e.target)) {
                this.hideDropdown();
            } else if (this.inputElement.contains(e.target)) {
                this.showDropdown();
            }
        });
  
      this.renderItems(this.items);
    }
  
    filterItems(searchText) {
        const filtered = this.items.filter(item => 
            item.toLowerCase().includes(searchText.toLowerCase())
        );
        
        this.renderItems(filtered);
        this.showDropdown();
    }
  
    renderItems(items) {
        this.listElement.innerHTML = '';
        
        items.forEach(item => {
            const li = document.createElement('li');
            li.textContent = item;
            li.addEventListener('click', () => this.selectItem(item));
            this.listElement.appendChild(li);
        });
    }
  
    selectItem(value) {
        this.inputElement.value = value;
        this.hideDropdown();
    }
  
    showDropdown() {
        this.listElement.style.display = 'block';
    }
  
    hideDropdown() {
        this.listElement.style.display = 'none';
    }
  }
  