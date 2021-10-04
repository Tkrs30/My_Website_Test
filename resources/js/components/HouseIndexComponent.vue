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
      Selected Rows:<br>
      {{ selected }}
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
      ],
      items: [],
      selectMode: 'multi',
      selected: []
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
    onRowSelected(items) {
      this.selected = items
    },
    selectAllRows() {
      this.$refs.selectableTable.selectAllRows()
    },
    clearSelected() {
      this.$refs.selectableTable.clearSelected()
    },
    selectThirdRow() {
      // Rows are indexed from 0, so the third row is index 2
      this.$refs.selectableTable.selectRow(2)
    },
    unselectThirdRow() {
      // Rows are indexed from 0, so the third row is index 2
      this.$refs.selectableTable.unselectRow(2)
    }
  },
  created() {
    this.getUser()
  },
};
</script>

<style scoped>
</style>