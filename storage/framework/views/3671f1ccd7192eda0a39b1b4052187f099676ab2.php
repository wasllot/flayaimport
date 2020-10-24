<div class="table">
    <datagrid-filters></datagrid-filters>

    <?php if(isset($results['paginated']) && $results['paginated']): ?>
        <?php echo $__env->make('ui::datagrid.pagination', ['results' => $results['records']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php $__env->startPush('scripts'); ?>
        <script type="text/x-template" id="datagrid-filters">
            <div class="grid-container">

                <div class="datagrid-filters">
                    <div class="filter-left">
                        <?php if(isset($results['extraFilters']['channels'])): ?>
                        <div class="dropdown-filters per-page">
                            <div class="control-group">
                                <select class="control" id="channel-switcher" name="channel"
                                        onchange="reloadPage('channel', this.value)">
                                    <option value="all" <?php echo e(! isset($channel) ? 'selected' : ''); ?>>
                                        <?php echo e(__('admin::app.admin.system.all-channels')); ?>

                                    </option>
                                    <?php $__currentLoopData = $results['extraFilters']['channels']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channelModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($channelModel->id); ?>"
                                            <?php echo e((isset($channel) && ($channelModel->id) == $channel) ? 'selected' : ''); ?>>
                                            <?php echo e($channelModel->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(isset($results['extraFilters']['locales'])): ?>
                        <div class="dropdown-filters per-page">
                            <div class="control-group">
                                <select class="control" id="locale-switcher" name="locale"
                                        onchange="reloadPage('locale', this.value)">
                                    <option value="all" <?php echo e(! isset($locale) ? 'selected' : ''); ?>>
                                        <?php echo e(__('admin::app.admin.system.all-locales')); ?>

                                    </option>
                                    <?php $__currentLoopData = $results['extraFilters']['locales']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $localeModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($localeModel->code); ?>" <?php echo e((isset($locale) && ($localeModel->code) == $locale) ? 'selected' : ''); ?>>
                                            <?php echo e($localeModel->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if(isset($results['extraFilters']['customer_groups'])): ?>
                        <div class="dropdown-filters per-page">
                            <div class="control-group">
                                <select class="control" id="customer-group-switcher" name="customer_group"
                                        onchange="reloadPage('customer_group', this.value)">
                                    <option value="all" <?php echo e(! isset($customer_group) ? 'selected' : ''); ?>>
                                        <?php echo e(__('admin::app.admin.system.all-customer-groups')); ?>

                                    </option>
                                    <?php $__currentLoopData = $results['extraFilters']['customer_groups']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customerGroupModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($customerGroupModel->id); ?>"
                                            <?php echo e((isset($customer_group) && ($customerGroupModel->id) == $customer_group) ? 'selected' : ''); ?>>
                                            <?php echo e($customerGroupModel->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="datagrid-filters" id="datagrid-filters">
                    <div class="filter-left">
                        <div class="search-filter">
                            <input type="search" id="search-field" class="control"
                                   placeholder="<?php echo e(__('ui::app.datagrid.search')); ?>" v-model="searchValue"
                                   v-on:keyup.enter="searchCollection(searchValue)"/>

                            <div class="icon-wrapper">
                                <span class="icon search-icon search-btn"
                                      v-on:click="searchCollection(searchValue)"></span>
                            </div>
                        </div>
                    </div>

                    <div class="filter-right">
                        <div class="dropdown-filters per-page">
                            <div class="control-group">
                                <label class="per-page-label" for="perPage">
                                    <?php echo e(__('ui::app.datagrid.items-per-page')); ?>

                                </label>

                                <select id="perPage" name="perPage" class="control" v-model="perPage"
                                        v-on:change="paginate">
                                    <option value="10"> 10</option>
                                    <option value="20"> 20</option>
                                    <option value="30"> 30</option>
                                    <option value="40"> 40</option>
                                    <option value="50"> 50</option>
                                </select>
                            </div>
                        </div>

                        <div class="dropdown-filters">
                            <div class="dropdown-toggle">
                                <div class="grid-dropdown-header">
                                    <span class="name"><?php echo e(__('ui::app.datagrid.filter')); ?></span>
                                    <i class="icon arrow-down-icon active"></i>
                                </div>
                            </div>

                            <div class="dropdown-list dropdown-container" style="display: none;">
                                <ul>
                                    <li>
                                        <div class="control-group">
                                            <select class="filter-column-select control" v-model="filterColumn"
                                                    v-on:click="getColumnOrAlias(filterColumn)">
                                                <option selected disabled><?php echo e(__('ui::app.datagrid.column')); ?></option>
                                                <?php $__currentLoopData = $results['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(isset($column['filterable']) && $column['filterable']): ?>
                                                        <option value="<?php echo e($column['index']); ?>">
                                                            <?php echo e($column['label']); ?>

                                                        </option>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </li>

                                    
                                    <li v-if='stringConditionSelect'>
                                        <div class="control-group">
                                            <select class="control" v-model="stringCondition">
                                                <option selected
                                                        disabled><?php echo e(__('ui::app.datagrid.condition')); ?></option>
                                                <option value="like"><?php echo e(__('ui::app.datagrid.contains')); ?></option>
                                                <option value="nlike"><?php echo e(__('ui::app.datagrid.ncontains')); ?></option>
                                                <option value="eq"><?php echo e(__('ui::app.datagrid.equals')); ?></option>
                                                <option value="neqs"><?php echo e(__('ui::app.datagrid.nequals')); ?></option>
                                            </select>
                                        </div>
                                    </li>

                                    
                                    <li v-if='stringCondition != null'>
                                        <div class="control-group">
                                            <input type="text" class="control response-string"
                                                   placeholder="<?php echo e(__('ui::app.datagrid.value-here')); ?>"
                                                   v-model="stringValue"/>
                                        </div>
                                    </li>

                                    
                                    <li v-if='numberConditionSelect'>
                                        <div class="control-group">
                                            <select class="control" v-model="numberCondition">
                                                <option selected
                                                        disabled><?php echo e(__('ui::app.datagrid.condition')); ?></option>
                                                <option value="eq"><?php echo e(__('ui::app.datagrid.equals')); ?></option>
                                                <option value="neqs"><?php echo e(__('ui::app.datagrid.nequals')); ?></option>
                                                <option value="gt"><?php echo e(__('ui::app.datagrid.greater')); ?></option>
                                                <option value="lt"><?php echo e(__('ui::app.datagrid.less')); ?></option>
                                                <option value="gte"><?php echo e(__('ui::app.datagrid.greatere')); ?></option>
                                                <option value="lte"><?php echo e(__('ui::app.datagrid.lesse')); ?></option>
                                            </select>
                                        </div>
                                    </li>

                                    <li v-if='numberCondition != null'>
                                        <div class="control-group">
                                            <input type="text" class="control response-number" v-on:input="filterNumberInput" placeholder="<?php echo e(__('ui::app.datagrid.numeric-value-here')); ?>"  v-model="numberValue"/>
                                        </div>
                                    </li>

                                    
                                    <li v-if='booleanConditionSelect'>
                                        <div class="control-group">
                                            <select class="control" v-model="booleanCondition">
                                                <option selected
                                                        disabled><?php echo e(__('ui::app.datagrid.condition')); ?></option>
                                                <option value="eq"><?php echo e(__('ui::app.datagrid.equals')); ?></option>
                                                <option value="neqs"><?php echo e(__('ui::app.datagrid.nequals')); ?></option>
                                            </select>
                                        </div>
                                    </li>

                                    <li v-if='booleanCondition != null'>
                                        <div class="control-group">
                                            <select class="control" v-model="booleanValue">
                                                <option selected disabled><?php echo e(__('ui::app.datagrid.value')); ?></option>
                                                <option value="1"><?php echo e(__('ui::app.datagrid.true')); ?></option>
                                                <option value="0"><?php echo e(__('ui::app.datagrid.false')); ?></option>
                                            </select>
                                        </div>
                                    </li>

                                    
                                    <li v-if='datetimeConditionSelect'>
                                        <div class="control-group">
                                            <select class="control" v-model="datetimeCondition">
                                                <option selected
                                                        disabled><?php echo e(__('ui::app.datagrid.condition')); ?></option>
                                                <option value="eq"><?php echo e(__('ui::app.datagrid.equals')); ?></option>
                                                <option value="neqs"><?php echo e(__('ui::app.datagrid.nequals')); ?></option>
                                                <option value="gt"><?php echo e(__('ui::app.datagrid.greater')); ?></option>
                                                <option value="lt"><?php echo e(__('ui::app.datagrid.less')); ?></option>
                                                <option value="gte"><?php echo e(__('ui::app.datagrid.greatere')); ?></option>
                                                <option value="lte"><?php echo e(__('ui::app.datagrid.lesse')); ?></option>
                                                
                                            </select>
                                        </div>
                                    </li>

                                    <li v-if='datetimeCondition != null'>
                                        <div class="control-group">
                                            <input class="control" v-model="datetimeValue" type="date">
                                        </div>
                                    </li>

                                    <button class="btn btn-sm btn-primary apply-filter"
                                            v-on:click="getResponse"><?php echo e(__('ui::app.datagrid.apply')); ?></button>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filtered-tags">
                    <span class="filter-tag" v-if="filters.length > 0" v-for="filter in filters"
                          style="text-transform: capitalize;">
                        <span v-if="filter.column == 'perPage'">perPage</span>
                        <span v-else>{{ filter.label }}</span>

                        <span class="wrapper" v-if="filter.prettyValue">
                            {{ filter.prettyValue }}
                            <span class="icon cross-icon" v-on:click="removeFilter(filter)"></span>
                        </span>
                        <span class="wrapper" v-else>
                            {{ decodeURIComponent(filter.val) }}
                            <span class="icon cross-icon" v-on:click="removeFilter(filter)"></span>
                        </span>
                    </span>
                </div>

                <table class="table">
                    <?php echo $__env->make('ui::datagrid.partials.mass-action-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('ui::datagrid.partials.default-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('ui::datagrid.body', ['records' => $results['records'], 'actions' => $results['actions'], 'index' => $results['index'], 'columns' => $results['columns'],'enableMassActions' => $results['enableMassActions'], 'enableActions' => $results['enableActions'], 'norecords' => $results['norecords']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </table>
            </div>
        </script>

        <script>
            Vue.component('datagrid-filters', {
                template: '#datagrid-filters',

                data: function () {
                    return {
                        filterIndex: <?php echo json_encode($results['index'], 15, 512) ?>,
                        gridCurrentData: <?php echo json_encode($results['records'], 15, 512) ?>,
                        massActions: <?php echo json_encode($results['massactions'], 15, 512) ?>,
                        massActionsToggle: false,
                        massActionTarget: null,
                        massActionType: null,
                        massActionValues: [],
                        massActionTargets: [],
                        massActionUpdateValue: null,
                        url: new URL(window.location.href),
                        currentSort: null,
                        dataIds: [],
                        allSelected: false,
                        sortDesc: 'desc',
                        sortAsc: 'asc',
                        sortUpIcon: 'sort-up-icon',
                        sortDownIcon: 'sort-down-icon',
                        currentSortIcon: null,
                        isActive: false,
                        isHidden: true,
                        searchValue: '',
                        filterColumn: true,
                        filters: [],
                        columnOrAlias: '',
                        type: null,
                        columns: <?php echo json_encode($results['columns'], 15, 512) ?>,
                        stringCondition: null,
                        booleanCondition: null,
                        numberCondition: null,
                        datetimeCondition: null,
                        stringValue: null,
                        booleanValue: null,
                        datetimeValue: '2000-01-01',
                        numberValue: 0,
                        stringConditionSelect: false,
                        booleanConditionSelect: false,
                        numberConditionSelect: false,
                        datetimeConditionSelect: false,
                        perPage: 10,
                        extraFilters: <?php echo json_encode($results['extraFilters'], 15, 512) ?>,
                    }
                },

                mounted: function () {
                    this.setParamsAndUrl();

                    if (this.filters.length) {
                        for (let i = 0; i < this.filters.length; i++) {
                            if (this.filters[i].column === 'perPage') {
                                this.perPage = this.filters[i].val;
                            }
                        }
                    }
                },

                methods: {
                    getColumnOrAlias: function (columnOrAlias) {
                        this.columnOrAlias = columnOrAlias;

                        for (column in this.columns) {
                            if (this.columns[column].index === this.columnOrAlias) {
                                this.type = this.columns[column].type;

                                switch (this.type) {

                                    case 'string': {
                                        this.stringConditionSelect = true;
                                        this.datetimeConditionSelect = false;
                                        this.booleanConditionSelect = false;
                                        this.numberConditionSelect = false;

                                        this.nullify();
                                        break;
                                    }
                                    case 'datetime': {
                                        this.datetimeConditionSelect = true;
                                        this.stringConditionSelect = false;
                                        this.booleanConditionSelect = false;
                                        this.numberConditionSelect = false;

                                        this.nullify();
                                        break;
                                    }
                                    case 'boolean': {
                                        this.booleanConditionSelect = true;
                                        this.datetimeConditionSelect = false;
                                        this.stringConditionSelect = false;
                                        this.numberConditionSelect = false;

                                        this.nullify();
                                        break;
                                    }
                                    case 'number': {
                                        this.numberConditionSelect = true;
                                        this.booleanConditionSelect = false;
                                        this.datetimeConditionSelect = false;
                                        this.stringConditionSelect = false;

                                        this.nullify();
                                        break;
                                    }
                                    case 'price': {
                                        this.numberConditionSelect = true;
                                        this.booleanConditionSelect = false;
                                        this.datetimeConditionSelect = false;
                                        this.stringConditionSelect = false;

                                        this.nullify();
                                        break;
                                    }

                                }
                            }
                        }
                    },

                    nullify: function () {
                        this.stringCondition = null;
                        this.datetimeCondition = null;
                        this.booleanCondition = null;
                        this.numberCondition = null;
                    },

                    filterNumberInput: function(e){
                        this.numberValue = e.target.value.replace(/[^0-9\,\.]+/g, '');                            
                    },

                    getResponse: function() {
                        label = '';

                        for (let colIndex in this.columns) {
                            if (this.columns[colIndex].index == this.columnOrAlias) {
                                label = this.columns[colIndex].label;
                                break;
                            }
                        }

                        if (this.type === 'string' && this.stringValue !== null) {
                            this.formURL(this.columnOrAlias, this.stringCondition, encodeURIComponent(this.stringValue), label)
                        } else if (this.type === 'number') {
                            indexConditions = true;

                            if (this.filterIndex === this.columnOrAlias
                                && (this.numberValue === 0 || this.numberValue < 0)) {
                                indexConditions = false;

                                alert('<?php echo e(__('ui::app.datagrid.zero-index')); ?>');
                            }

                            if (indexConditions) {
                                this.formURL(this.columnOrAlias, this.numberCondition, this.numberValue, label);
                            }
                        } else if (this.type === 'boolean') {
                            this.formURL(this.columnOrAlias, this.booleanCondition, this.booleanValue, label);
                        } else if (this.type === 'datetime') {
                            this.formURL(this.columnOrAlias, this.datetimeCondition, this.datetimeValue, label);
                        } else if (this.type === 'price') {
                            this.formURL(this.columnOrAlias, this.numberCondition, this.numberValue, label);
                        }
                    },

                    sortCollection: function (alias) {
                        let label = '';

                        for (let colIndex in this.columns) {
                            if (this.columns[colIndex].index === alias) {
                                matched = 0;
                                label = this.columns[colIndex].label;
                                break;
                            }
                        }

                        this.formURL("sort", alias, this.sortAsc, label);
                    },

                    searchCollection: function (searchValue) {
                        this.formURL("search", 'all', searchValue, 'Search');
                    },

                    // function triggered to check whether the query exists or not and then call the make filters from the url
                    setParamsAndUrl: function () {
                        params = (new URL(window.location.href)).search;

                        if (params.slice(1, params.length).length > 0) {
                            this.arrayFromUrl();
                        }

                        for (let id in this.massActions) {
                            targetObj = {
                                'type': this.massActions[id].type,
                                'action': this.massActions[id].action
                            };

                            this.massActionTargets.push(targetObj);

                            targetObj = {};

                            if (this.massActions[id].type === 'update') {
                                this.massActionValues = this.massActions[id].options;
                            }
                        }
                    },

                    findCurrentSort: function () {
                        for (let i in this.filters) {
                            if (this.filters[i].column === 'sort') {
                                this.currentSort = this.filters[i].val;
                            }
                        }
                    },

                    changeMassActionTarget: function () {
                        if (this.massActionType === 'delete') {
                            for (let i in this.massActionTargets) {
                                if (this.massActionTargets[i].type === 'delete') {
                                    this.massActionTarget = this.massActionTargets[i].action;

                                    break;
                                }
                            }
                        }

                        if (this.massActionType === 'update') {
                            for (let i in this.massActionTargets) {
                                if (this.massActionTargets[i].type === 'update') {
                                    this.massActionTarget = this.massActionTargets[i].action;

                                    break;
                                }
                            }
                        }

                        document.getElementById('mass-action-form').action = this.massActionTarget;
                    },

                    //make array of filters, sort and search
                    formURL: function (column, condition, response, label) {
                        var obj = {};

                        if (column === "" || condition === "" || response === ""
                            || column === null || condition === null || response === null) {
                            alert('<?php echo e(__('ui::app.datagrid.filter-fields-missing')); ?>');

                            return false;
                        } else {

                            if (this.filters.length > 0) {
                                if (column !== "sort" && column !== "search") {
                                    let filterRepeated = false;

                                    for (let j = 0; j < this.filters.length; j++) {
                                        if (this.filters[j].column === column) {
                                            if (this.filters[j].cond === condition && this.filters[j].val === response) {
                                                filterRepeated = true;

                                                return false;
                                            } else if (this.filters[j].cond === condition && this.filters[j].val !== response) {
                                                filterRepeated = true;

                                                this.filters[j].val = response;

                                                this.makeURL();
                                            }
                                        }
                                    }

                                    if (filterRepeated === false) {
                                        obj.column = column;
                                        obj.cond = condition;
                                        obj.val = response;
                                        obj.label = label;

                                        this.filters.push(obj);
                                        obj = {};

                                        this.makeURL();
                                    }
                                }

                                if (column === "sort") {
                                    let sort_exists = false;

                                    for (let j = 0; j < this.filters.length; j++) {
                                        if (this.filters[j].column === "sort") {
                                            if (this.filters[j].column === column && this.filters[j].cond === condition) {
                                                this.findCurrentSort();

                                                if (this.currentSort === "asc") {
                                                    this.filters[j].column = column;
                                                    this.filters[j].cond = condition;
                                                    this.filters[j].val = this.sortDesc;

                                                    this.makeURL();
                                                } else {
                                                    this.filters[j].column = column;
                                                    this.filters[j].cond = condition;
                                                    this.filters[j].val = this.sortAsc;

                                                    this.makeURL();
                                                }
                                            } else {
                                                this.filters[j].column = column;
                                                this.filters[j].cond = condition;
                                                this.filters[j].val = response;
                                                this.filters[j].label = label;

                                                this.makeURL();
                                            }

                                            sort_exists = true;
                                        }
                                    }

                                    if (sort_exists === false) {
                                        if (this.currentSort === null)
                                            this.currentSort = this.sortAsc;

                                        obj.column = column;
                                        obj.cond = condition;
                                        obj.val = this.currentSort;
                                        obj.label = label;

                                        this.filters.push(obj);

                                        obj = {};

                                        this.makeURL();
                                    }
                                }

                                if (column === "search") {
                                    let search_found = false;

                                    for (let j = 0; j < this.filters.length; j++) {
                                        if (this.filters[j].column === "search") {
                                            this.filters[j].column = column;
                                            this.filters[j].cond = condition;
                                            this.filters[j].val = encodeURIComponent(response);
                                            this.filters[j].label = label;

                                            this.makeURL();
                                        }
                                    }

                                    for (let j = 0; j < this.filters.length; j++) {
                                        if (this.filters[j].column === "search") {
                                            search_found = true;
                                        }
                                    }

                                    if (search_found === false) {
                                        obj.column = column;
                                        obj.cond = condition;
                                        obj.val = encodeURIComponent(response);
                                        obj.label = label;

                                        this.filters.push(obj);

                                        obj = {};

                                        this.makeURL();
                                    }
                                }
                            } else {
                                obj.column = column;
                                obj.cond = condition;
                                obj.val = encodeURIComponent(response);
                                obj.label = label;

                                this.filters.push(obj);

                                obj = {};

                                this.makeURL();
                            }
                        }
                    },

                    // make the url from the array and redirect
                    makeURL: function () {
                        newParams = '';

                        for(let i = 0; i < this.filters.length; i++) {
                            if (this.filters[i].column == 'status' || this.filters[i].column == 'value_per_locale' || this.filters[i].column == 'value_per_channel' || this.filters[i].column == 'is_unique') {
                                if (this.filters[i].val.includes("True")) {
                                    this.filters[i].val = 1;
                                } else if (this.filters[i].val.includes("False")) {
                                    this.filters[i].val = 0;
                                }
                            }

                            let condition = '';
                            if (this.filters[i].cond !== undefined) {
                                condition = '[' + this.filters[i].cond + ']';
                            }

                            if (i == 0) {
                                newParams = '?' + this.filters[i].column + condition + '=' + this.filters[i].val;
                            } else {
                                newParams = newParams + '&' + this.filters[i].column + condition + '=' + this.filters[i].val;
                            }
                        }

                        var uri = window.location.href.toString();

                        var clean_uri = uri.substring(0, uri.indexOf("?")).trim();

                        window.location.href = clean_uri + newParams;
                    },

                    //make the filter array from url after being redirected
                    arrayFromUrl: function () {

                        let obj = {};
                        const processedUrl = this.url.search.slice(1, this.url.length);
                        let splitted = [];
                        let moreSplitted = [];

                        splitted = processedUrl.split('&');

                        for (let i = 0; i < splitted.length; i++) {
                            moreSplitted.push(splitted[i].split('='));
                        }

                        for (let i = 0; i < moreSplitted.length; i++) {
                            const key = decodeURI(moreSplitted[i][0]);
                            let value = decodeURI(moreSplitted[i][1]);

                            if (value.includes('+')) {
                                value = value.replace('+', ' ');
                            }

                            obj.column = key.replace(']', '').split('[')[0];
                            obj.cond = key.replace(']', '').split('[')[1]
                            obj.val = value;

                            switch (obj.column) {
                                case "search":
                                    obj.label = "Search";
                                    break;
                                case "channel":
                                    obj.label = "Channel";
                                    if ('channels' in this.extraFilters) {
                                        obj.prettyValue = this.extraFilters['channels'].find(channel => channel.id == obj.val).name
                                    }
                                    break;
                                case "locale":
                                    obj.label = "Locale";
                                    if ('locales' in this.extraFilters) {
                                        obj.prettyValue = this.extraFilters['locales'].find(locale => locale.code === obj.val).name
                                    }
                                    break;
                                case "customer_group":
                                    obj.label = "Customer Group";
                                    if ('customer_groups' in this.extraFilters) {
                                        obj.prettyValue = this.extraFilters['customer_groups'].find(customer_group => customer_group.id === parseInt(obj.val, 10)).name
                                    }
                                    break;
                                case "sort":
                                    for (let colIndex in this.columns) {
                                        if (this.columns[colIndex].index === obj.cond) {
                                            obj.label = this.columns[colIndex].label;
                                            break;
                                        }
                                    }
                                    break;
                                default:
                                    for (let colIndex in this.columns) {
                                        if (this.columns[colIndex].index === obj.column) {
                                            obj.label = this.columns[colIndex].label;

                                            if (this.columns[colIndex].type === 'boolean') {
                                                if (obj.val === '1') {
                                                    obj.val = '<?php echo e(__('ui::app.datagrid.true')); ?>';
                                                } else {
                                                    obj.val = '<?php echo e(__('ui::app.datagrid.false')); ?>';
                                                }
                                            }
                                        }
                                    }
                                    break;
                            }

                            if (obj.column !== undefined && obj.val !== undefined) {
                                this.filters.push(obj);
                            }

                            obj = {};
                        }
                    },

                    removeFilter: function (filter) {
                        for (let i in this.filters) {
                            if (this.filters[i].column === filter.column
                                && this.filters[i].cond === filter.cond
                                && this.filters[i].val === filter.val) {
                                this.filters.splice(i, 1);

                                this.makeURL();
                            }
                        }
                    },

                    //triggered when any select box is clicked in the datagrid
                    select: function () {
                        this.allSelected = false;

                        if (this.dataIds.length === 0) {
                            this.massActionsToggle = false;
                            this.massActionType = null;
                        } else {
                            this.massActionsToggle = true;
                        }
                    },

                    //triggered when master checkbox is clicked
                    selectAll: function () {
                        this.dataIds = [];

                        this.massActionsToggle = true;

                        if (this.allSelected) {
                            if (this.gridCurrentData.hasOwnProperty("data")) {
                                for (let currentData in this.gridCurrentData.data) {

                                    let i = 0;
                                    for (let currentId in this.gridCurrentData.data[currentData]) {
                                        if (i == 0) {
                                            this.dataIds.push(this.gridCurrentData.data[currentData][this.filterIndex]);
                                        }

                                        i++;
                                    }
                                }
                            } else {
                                for (currentData in this.gridCurrentData) {

                                    let i = 0;
                                    for (let currentId in this.gridCurrentData[currentData]) {
                                        if (i === 0)
                                            this.dataIds.push(this.gridCurrentData[currentData][currentId]);

                                        i++;
                                    }
                                }
                            }
                        }
                    },

                    doAction: function (e) {
                        var element = e.currentTarget;

                        if (confirm('<?php echo e(__('ui::app.datagrid.massaction.delete')); ?>')) {
                            axios.post(element.getAttribute('data-action'), {
                                _token: element.getAttribute('data-token'),
                                _method: element.getAttribute('data-method')
                            }).then(function (response) {
                                this.result = response;

                                if (response.data.redirect) {
                                    window.location.href = response.data.redirect;
                                } else {
                                    location.reload();
                                }
                            }).catch(function (error) {
                                location.reload();
                            });

                            e.preventDefault();
                        } else {
                            e.preventDefault();
                        }
                    },

                    captureColumn: function (id) {
                        element = document.getElementById(id);

                    },

                    removeMassActions: function () {
                        this.dataIds = [];

                        this.massActionsToggle = false;

                        this.allSelected = false;

                        this.massActionType = null;
                    },

                    paginate: function (e) {
                        for (let i = 0; i < this.filters.length; i++) {
                            if (this.filters[i].column == 'perPage') {
                                this.filters.splice(i, 1);
                            }
                        }

                        this.filters.push({"column": "perPage", "cond": "eq", "val": e.target.value});

                        this.makeURL();
                    }
                }
            });
        </script>
    <?php $__env->stopPush(); ?>
</div>
<?php /**PATH C:\Users\user\Desktop\website-builder\packages\Webkul\Ui\src\Providers/../Resources/views/datagrid/table.blade.php ENDPATH**/ ?>