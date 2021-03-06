#!/bin/sh

#  Licensed under the Apache License, Version 2.0 (the "License"); you may
#  not use this file except in compliance with the License. You may obtain
#  a copy of the License at
#  
#       http://www.apache.org/licenses/LICENSE-2.0
#  
#  Unless required by applicable law or agreed to in writing, software
#  distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
#  WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
#  License for the specific language governing permissions and limitations
#  under the License.
#  
#  COPYRIGHT  (C)  NEC  CORPORATION  2017
#  

#
#     Initialization of the create node
#
. ${NALPATH}/common/NAL_C_Common.sh

`pyfunc tenant_id_convert`
status=$?
if [ $status != 0 ] ; then
    exit $status
fi

if [ ${NAL_JOBNAME} = ${JOB_NAME_CREATE_VFW} -o ${NAL_JOBNAME} = ${JOB_NAME_CREATE_VLB}  ] ; then
    ###VNF creation###
    `pyfunc initialize_create_vnf`
    status=$?
    if [ $status != 0 ] ; then
        exit $status
    fi

    `pyfunc routing_pod`
    status=$?
    if [ $status != 0 ] ; then
        exit $status
    fi

elif [ ${NAL_JOBNAME} = ${JOB_NAME_CREATE_PFW} -o ${NAL_JOBNAME} = ${JOB_NAME_CREATE_PLB}  ] ; then
    ###PNF creation###
    `pyfunc initialize_create_pnf`
    status=$?
    if [ $status != 0 ] ; then
        exit $status
    fi
fi

`pyfunc get_or_create_pod_tenant`
status=$?
if [ $status != 0 ] ; then
    exit $status
fi

if [ ${NAL_JOBNAME} = ${JOB_NAME_CREATE_VFW} -o ${NAL_JOBNAME} = ${JOB_NAME_CREATE_VLB}  ] ; then
    ###VNF creation###
    `pyfunc hostname_check`
fi
exit $?
