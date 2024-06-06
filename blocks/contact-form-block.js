wp.blocks.registerBlockType("bcf/bootstrap-contact-form", {
    title: "Bootstrap Contact Form",
    icon: "email",
    edit: EditComponent,
    save: SaveComponent
})

function EditComponent() {
    return (
        `[bcf_contact_form]`
    )
}

function SaveComponent() {
    return null
}