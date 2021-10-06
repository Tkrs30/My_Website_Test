<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <b-container fluid>
        <b-form-group
        label="Selection mode:"
        label-for="table-select-mode-select"
        label-cols-md="4"
        >
          <b-form-select
            id="table-select-mode-select"
            v-model="selectMode"
            :options="modes"
            class="mb-3"
          ></b-form-select>
        </b-form-group>

        <b-col lg="6" class="my-1">
          <b-form-group
            label="Filter"
            label-for="filter-input"
            label-cols-sm="3"
            label-align-sm="right"
            label-size="sm"
            class="mb-0"
          >
            <b-input-group size="sm">
              <b-form-input
                id="filter-input"
                v-model="filter"
                type="search"
                placeholder="Type to Search"
              ></b-form-input>

              <b-input-group-append>
                <b-button @click="filter = 'name'">Clear</b-button>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>

        <b-col sm="5" md="6" class="my-1">
          <b-form-group
            label="Per page"
            label-for="per-page-select"
            label-cols-sm="6"
            label-cols-md="4"
            label-cols-lg="3"
            label-align-sm="right"
            label-size="sm"
            class="mb-0"
          >
            <b-form-select
              id="per-page-select"
              v-model="perPage"
              :options="pageOptions"
              size="sm"
            ></b-form-select>
          </b-form-group>
        </b-col>

        <b-table hover
          :fields="fields"
          :items="items"
          :select-mode="selectMode"
          ref="selectableTable"
          selectable
          @row-selected="onRowSelected"
          :current-page="currentPage"
          :per-page="perPage"
          :filter="filter"
          :filter-included-fields="filterOn"
          :sort-by.sync="sortBy"
          :sort-desc.sync="sortDesc"
          :sort-direction="sortDirection"
          stacked="md"
          show-empty
          small
          @filtered="onFiltered"
        >
          <template #cell(show_details)="row">
            <b-button size="sm" @click="row.toggleDetails" class="mr-2">
              {{ row.detailsShowing ? 'Hide' : 'Show'}} Details
            </b-button>
          </template>

          <template #row-details="row">
            <b-card>
              <b-row class="mb-2">
                <b-col sm="3" class="text-sm-right"><b>Date:</b></b-col>
                <b-col>{{ new Date(row.item.created_at).toUTCString() }}</b-col>
              </b-row>
              <b-button size="sm" @click="row.toggleDetails">Hide Details</b-button>
            </b-card>
          </template>

          <template #cell(selected)="{ rowSelected }">
            <template v-if="rowSelected">
              <span aria-hidden="true">&check;</span>
              <span class="sr-only">Selected</span>
            </template>

            <template v-else>
              <span aria-hidden="true">&nbsp;</span>
              <span class="sr-only">Not selected</span>
            </template>
          </template>
          <template #cell(price)="data">
            <template v-if=" data.item.price > customDropdown">
              <b-button @click="sendInfo(data.item.id)" class="btn btn-danger" v-b-modal.modal-1>{{ data.item.price }}</b-button>
            </template>
            <template v-else>
              {{ data.item.price }}
            </template>
          </template>

          <template #cell(price2)="data">
            {{ data.item.price + (data.item.price * 0.2) }}
          </template>

          <template #cell(button1)="data">
            <a class="btn btn-primary" :href="`${'/houses/' + data.item.id + '/edit' }`" role="button">Modifier</a>
          </template>

          <template #cell(button2)="data">
            <a class="btn btn-danger" :href="`${'/houses/' + data.item.id + '/delete' }`" role="button">Supprimer</a>
          </template>

          <template #cell(button3)="data">
            <a class="btn btn-success" :href="`${'/houses/' + data.item.id + '/duplicate' }`" role="button">Dupliquer</a>
          </template>

        </b-table>

        <p>
          <b-button size="sm" @click="selectAllRows">Tout selectionner</b-button>
          <b-button size="sm" @click="clearSelected">Déselectionner tout</b-button>
          <b-button size="sm" @click="selectDelete">Supprimer la selection</b-button>
        </p>

        <b-col sm="7" md="6" class="my-1 p-4 container text-center">
          <b-pagination
            v-model="currentPage"
            :total-rows="totalRows"
            :per-page="perPage"
            align="fill"
            size="sm"
            class="my-0"
          ></b-pagination>
        </b-col>

        <b-modal id="modal-1" title="BootstrapVue">
          <template #modal-title>
            C'est trop cher ! {{ selectedData }}
          </template>
          <div class="d-block text-center">
            <h3>Veuilliez supprimer votre annonce :</h3>
            <a class="btn btn-danger" :href="`${'/houses/' + selectedData + '/delete' }`" role="button">Supprimer</a>
          </div>
        </b-modal>

        <div class="p-4 container text-center">
            <a class="btn btn-primary" :href="`${'/houses/create/'}`" role="button">Créer une nouvelle habitation</a>
        </div>
      </b-container>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      modes: ['multi', 'single', 'range'],
      fields: [
        {
          key: 'name',
          sortable: true,
          variant: 'danger',
        },
        {
          key: 'address',
          sortable: true,
        },
        {
          key: 'price',
          sortable: true,
        },
        {
          key: 'surface',
          sortable: true,
        },
        {
          key: 'price2',
          label : 'Prix TTC',
          sortable: true,
        },
        {
          key: 'button1',
          label : '',
        },
        {
          key: 'button2',
          label : '',
        },
        {
          key: 'button3',
          label : '',
        },
        'show_details',
      ],
      totalRows: 1,
      currentPage: 1,
      perPage: 5,
      pageOptions: [5, 10, 15, { value: 100, text: "Show a lot" }],
      sortBy: '',
      sortDesc: false,
      sortDirection: 'asc',
      filter: null,
      filterOn: ['name'],
      infoModal: {
        id: 'info-modal',
        title: '',
        content: ''
      },
      items: [],
      selectMode: 'multi',
      selected: [],
      customDropdown: 500000,
      selectedData: '',
    };
  },
  computed: {
    sortOptions() {
      return this.fields
        .filter(f => f.sortable)
        .map(f => {
          return { text: f.label, value: f.key }
        })
    }
  },
  mounted() {
    this.getUser()
  },
  methods: {
    getUser(){
      axios.get('/data/houses')
        .then((response)=>{
          this.items = response.data
          this.totalRows = this.items.length
        })
    },
    selectDelete() {
      axios.get('/data/deleted', {
        params: {
          items : this.selected,
        }
      })
      .then((response)=>{
        document.location.href = "/houses";
      })
      .catch((response => {
        console.log("c'est passe ici !")
      }))
    },
    onRowSelected(items) {
      this.selected = items
    },
    selectAllRows() {
      this.$refs.selectableTable.selectAllRows()
    },
    clearSelected() {
      this.$refs.selectableTable.clearSelected()
    },
    onFiltered(filteredItems) {
      this.totalRows = filteredItems.length
      this.currentPage = 1
    },
    sendInfo(item) {
      this.selectedData = item;
    },
  },
};
</script>

<style scoped>
</style>