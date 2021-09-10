<template>
    <div class='mb-4'>

        <ul class="pagination pagination-sm">

            <li class="page-item "  aria-disabled="true" :class="{ disabled: source.current_page == 1}">
                <a class="page-link" href="#"  @click="nextPrev($event, source.current_page-1)" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li v-for="(page, i) in pages" :key="i"  class='page-item' :class="{ active: source.current_page == page }">
                <span v-if="page == '...'" class='page-link'>{{ page }}</span>
                <a  v-if="page != '...'" class="page-link"  aria-hidden="true" @click="navigate($event, page)" href="#">{{ page }}</a>
            </li>

            <li class="page-item" :class="{ disabled: source.current_page == source.last_page}">
                <a class="page-link" @click="nextPrev($event, source.current_page+1)" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>

        </ul>

    </div>
</template>

<script>

import { mapState, mapActions } from 'vuex'

export default {

    props:['source'],

    data () {
        return {
            pages: [],

        }
    },


    methods: {
        navigate(ev, page){
            ev.preventDefault();
            this.$emit('navigate', page)
        },
        nextPrev (ev, page) {
            if(page == 0 || page == this.source.last_page+1){
                return
            }

            this.navigate(ev, page)
        },

        generatePagesArray: function(currentPage, collectionLength, rowsPerPage, paginationRange)
        {
            var pages = [];
            var totalPages = Math.ceil(collectionLength / rowsPerPage);
            var halfWay = Math.ceil(paginationRange / 2);
            var position;

            if (currentPage <= halfWay) {
                position = 'start';
            } else if (totalPages - halfWay < currentPage) {
                position = 'end';
            } else {
                position = 'middle';
            }

            var ellipsesNeeded = paginationRange < totalPages;
            var i = 1;
            while (i <= totalPages && i <= paginationRange) {
                var pageNumber = this.calculatePageNumber(i, currentPage, paginationRange, totalPages);
                var openingEllipsesNeeded = (i === 2 && (position === 'middle' || position === 'end'));
                var closingEllipsesNeeded = (i === paginationRange - 1 && (position === 'middle' || position === 'start'));
                if (ellipsesNeeded && (openingEllipsesNeeded || closingEllipsesNeeded)) {
                    pages.push('...');
                } else {
                    pages.push(pageNumber);
                }
                i ++;
            }
            return pages;
        },

        calculatePageNumber: function(i, currentPage, paginationRange, totalPages)
        {
            var halfWay = Math.ceil(paginationRange/2);
            if (i === paginationRange) {
                return totalPages;
            } else if (i === 1) {
                return i;
            } else if (paginationRange < totalPages) {
                if (totalPages - halfWay < currentPage) {
                return totalPages - paginationRange + i;
            } else if (halfWay < currentPage) {
                return currentPage - halfWay + i;
            } else {
                return i;
            }
            } else {
                return i;
            }
        },
    },

    computed:{
        dados(){
            return this.pages = this.generatePagesArray(this.source.current_page, this.source.total, this.source.per_page, 10)
        }
    },
    watch: {

        source () {
            this.pages = this.generatePagesArray(this.source.current_page, this.source.total, this.source.per_page, 10)
        }

    },

    created(){
        this.dados
    }

}

</script>
