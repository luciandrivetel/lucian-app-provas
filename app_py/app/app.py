import streamlit as st
from PIL import Image
from writedb import use_db
from datetime import datetime
import pandas as pd
import io
import xlsxwriter

current_year = datetime.now().strftime("%Y")
current_month = datetime.now().strftime("%m")
today = datetime.now().strftime("%Y-%m-%d")

def to_excel(df):
    output = io.BytesIO()
    with pd.ExcelWriter(output, engine="xlsxwriter") as writer:
        df.to_excel(writer, index=False, sheet_name="Date")
    return output.getvalue()

def main():
    st.set_page_config(page_title="Provas Medinfar")
    #Display logo
    img = Image.open("logo_Tipocor.png")
    col_1, col_2, col_3 = st.columns([1, 2, 1])
    with col_2:
        st.image(img, width=400)
    #Display Title
    st.title("Provas novas Medinfar")

# New proof
    st.header("Prova nova")

    with st.form(key="new_proof"):
        proof_name = st.text_input("O nome do material")
        proof_code = st.text_input("Referência (se não tem referência mete: sem código)")
        comment = st.text_input("Comentário")
        submit_button = st.form_submit_button("Guardar")
        if proof_name and proof_code and submit_button:
            proof_code_pattern = f"%{proof_code}%"
            if use_db("search", "medinfar", (None, proof_code_pattern)):
                st.error("Essa prova já existe na base de dados")
            else:
                writedb = use_db("write", "medinfar", (proof_name, proof_code, today, comment))
                if writedb == 0:
                    st.success("Prova guardada")
                elif writedb == 1:
                    st.error("database error")
        elif (not proof_name or not proof_code) and submit_button:
            st.warning("Campos obrigatórios")
# Search proof
    st.header("Procurar provas feitas")
    search_value = st.text_input("Nome ou rferência da prova:")
    if search_value:
        search_pattern = f"%{search_value}%"
        search_result = use_db("search", "medinfar", (search_pattern, search_pattern))
        if search_result:
            for result in search_result:
                st.write(f"{result[1]} - {result[2]}  /  {result[3]}      {result[4]}")
        else:
            st.info("Nenhuma prova encontrada")



# Proof saved in db
    st.header("Provas feitas")

    months = {
        "Janeiro": "01",
        "Fevreiro": "02",
        "Março": "03",
        "Abril": "04",
        "Maio": "05",
        "Junho": "06",
        "Julho": "07",
        "Agosto": "08",
        "Setembro": "09",
        "Outobro": "10",
        "Novembro": "11",
        "Dezembro": "12"
    }

    col1, col2 = st.columns(2)
    with col1:
        month = st.selectbox("Escolha a mês", [month for month in months.keys()])
        month = months[month]
    with col2:
        year = st.text_input("Digite o ano", current_year)
    proofs = use_db("read", "medinfar", (f"{year}-{month}", ))
    if proofs:
        df = pd.DataFrame(proofs)
        df.columns = ["Material", "Referência", "Data", "Comentário"]
        df.index = range(1, len(df)+1)
        st.markdown(df.to_html(index=True, escape=False, border=1), unsafe_allow_html=True)
        excel_file = to_excel(df)
        st.download_button(label="Download xlsx", data=excel_file, file_name=f"{month}_{year}_Medinfar.xlsx")
    else:
        st.warning(f"Não há provas feitas no mẽs {month} {year}")





if __name__ == "__main__":
    main()