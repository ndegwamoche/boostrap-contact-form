import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import React from 'react';

class BootstrapContactFormBlock {
    constructor() {
        this.registerBlock();
    }

    registerBlock() {
        registerBlockType('bcf/bootstrap-contact-form', {
            title: 'Bootstrap Contact Form',
            icon: 'email',
            category: 'widgets',
            edit: () => {
                const blockProps = useBlockProps();
                return (<></>);
            },
            save: () => {
                const blockProps = useBlockProps.save();
                return (<></>);
            },
        });
    }
}

export default BootstrapContactFormBlock;
