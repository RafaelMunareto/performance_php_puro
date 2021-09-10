<template>
  <div class="dropdown" v-if="options">

    <!-- Dropdown Input -->
    <input class="dropdown-input"
      :name="name"
      :class='data'
      @focus="showOptions()"
      @keyup="keyMonitor"
      @blur="exit()"
      v-model="searchFilter"
      :disabled="disabled"
      :placeholder="placeholder" />

    <!-- Dropdown Menu -->
    <div class="dropdown-content"
      :class='data'
      v-show="optionsShown">
      <div
        class="dropdown-item"
        :class='data'
        @mousedown="selectOption(option)"
        v-for="(option, index) in filteredOptions"
        :key="index">
          {{ option.name || option.id || '-' }}
      </div>
    </div>
  </div>


</template>

<script>
  export default {
    name: 'Dropdown',
    template: 'Dropdown',
    props: {
      name: {
        type: String,
        required: false,
        default: 'dropdown',
        note: 'Input name'
      },
      data:{
          type:String,
          required:false
      },

      options: {
        type: Array,
        required: true,
        default: [],
        note: 'Options of dropdown. An array of options with id and name',
      },
      placeholder: {
        type: String,
        required: false,
        default: 'Please select an option',
        note: 'Placeholder of dropdown'
      },
      disabled: {
        type: Boolean,
        required: false,
        default: false,
        note: 'Disable the dropdown'
      },
      maxItem: {
        type: Number,
        required: false,
        default: 6,
        note: 'Max items showing'
      },
      data:{
          type:String,
          require:true
      }
    },
    data() {
      return {
        selected: {},
        optionsShown: false,
        searchFilter: ''
      }
    },
    // created() {
    //   this.$emit('selected', this.selected);
    // },
    computed: {
      filteredOptions() {
        const filtered = [];
        const regOption = new RegExp(this.searchFilter, 'ig');
        for (const option of this.options) {
          if (this.searchFilter.length < 1 || option.name.match(regOption)){
            if (filtered.length < this.maxItem) filtered.push(option);
          }
        }
        return filtered;
      }
    },
    methods: {
      selectOption(option) {
        this.selected = option;
        this.optionsShown = false;
        this.searchFilter = this.selected.name;
        this.$emit('selected', this.selected);
        this.$emit("ativado");
      },
      showOptions(){
        if (!this.disabled) {
          this.searchFilter = '';
          this.optionsShown = true;
        }
      },
      exit() {
        if (!this.selected.id) {
          this.selected = {};
          this.searchFilter = '';
        } else {
          this.searchFilter = this.selected.name;
        }
        // this.$emit('selected', this.selected);
        this.optionsShown = false;
      },
      // Selecting when pressing Enter
      keyMonitor: function(event) {
        if (event.key === "Enter" && this.filteredOptions[0])
          this.selectOption(this.filteredOptions[0]);
      }
    },
    watch: {
      searchFilter() {
        if (this.filteredOptions.length === 0) {
          this.selected = {};
        } else {
          this.selected = this.filteredOptions[0];
        }
        this.$emit('filter', this.searchFilter);
      }
    }
  };
</script>


<style lang="scss" scoped>
  .dropdown {
    position: relative;
    display: block;
    margin: auto;
    .dropdown-input {
       box-shadow:  inset 2px 2px 5px #BABECC, inset -3px -5px 20px #e0eaf5;
      cursor: pointer;
      border: 1px solid #e7ecf5;
      border-radius: 3px;
      color: #333;
      background:#e0eaf5;
      display: block;
      font-size: .8em;
      padding: 6px;
      min-width: 250px;
      max-width: 250px;
      border-radius:5px;
      &:hover {
        box-shadow:  inset 1px 1px 2px #BABECC, inset -1px -1px 2px #fff;
      }
    }
    .dropdown-content {
      position: absolute;
      border-radius:5px;
      background:#e0eaf5;
      min-width: 248px;
      max-width: 248px;
      max-height: 248px;
      border: 1px solid #e7ecf5;
      box-shadow:  inset 2px 2px 5px #BABECC, inset -3px -5px 20px #e0eaf5;
      overflow: auto;
      z-index: 1;
      .dropdown-item {
        color: black;
        font-size: .7em;
        line-height: 1em;
        padding: 8px;
        text-decoration: none;
        display: block;
        cursor: pointer;
        &:hover {
          box-shadow:  inset 1px 1px 2px #BABECC, inset -1px -1px 2px #fff;
        }
      }
    }
    .dropdown:hover .dropdowncontent {
      display: block;
    }

    .data {
        min-width: 9rem !important;
        text-align: center;
    }

    .dataBig{
        min-width: 11rem !important;
        text-align: left;
    }

    .dataBig2x{
        min-width: 19rem !important;
        text-align: left;
        overflow: hidden;
    }

    .dataBig15x{
        min-width: 16rem !important;
        text-align: left;
        overflow: hidden;
    }

  }
</style>
