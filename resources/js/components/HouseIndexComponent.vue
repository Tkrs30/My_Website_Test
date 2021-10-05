<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

      <b-table hover :fields="fields" :items="items" :select-mode="selectMode" ref="selectableTable" selectable @row-selected="onRowSelected">
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
          sortable: true,
        },
        {
          key: 'button2',
          label : '',
          sortable: true,
        },
        {
          key: 'button3',
          label : '',
          sortable: true,
        },
        'show_details',
      ],
      items: [],
      selectMode: 'multi',
      selected: [],
    };
  },
  mounted() {
    console.log(this.items);
  },
  methods: {
    getUser(){
      axios.get('/data/houses')
        .then((response)=>{
          this.items = response.data
        })
    },
    selectDelete() {
      axios.get('/data/deleted', {
        params: {
          items : this.selected,
        }
      })
      .then((response)=>{
        console.log("c'est passe la !")
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
  },
  created() {
    this.getUser()
  },
};
</script>

<style scoped>
</style>