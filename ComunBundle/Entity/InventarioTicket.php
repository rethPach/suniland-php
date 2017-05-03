<?php

namespace Suniland\ComunBundle\Entity;

/**
 * InventarioTicket
 */
class InventarioTicket
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $ticketInicial;

    /**
     * @var integer
     */
    private $ticketFinal;

    /**
     * @var integer
     */
    private $totalTicket;

    /**
     * @var boolean
     */
    private $activo;

    /**
     * @var integer
     */
    private $stock;

    /**
     * @var \Suniland\ComunBundle\Entity\TipoEntrada
     */
    private $idTipoEntrada;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ticketInicial
     *
     * @param integer $ticketInicial
     *
     * @return InventarioTicket
     */
    public function setTicketInicial($ticketInicial)
    {
        $this->ticketInicial = $ticketInicial;

        return $this;
    }

    /**
     * Get ticketInicial
     *
     * @return integer
     */
    public function getTicketInicial()
    {
        return $this->ticketInicial;
    }

    /**
     * Set ticketFinal
     *
     * @param integer $ticketFinal
     *
     * @return InventarioTicket
     */
    public function setTicketFinal($ticketFinal)
    {
        $this->ticketFinal = $ticketFinal;

        return $this;
    }

    /**
     * Get ticketFinal
     *
     * @return integer
     */
    public function getTicketFinal()
    {
        return $this->ticketFinal;
    }

    /**
     * Set totalTicket
     *
     * @param integer $totalTicket
     *
     * @return InventarioTicket
     */
    public function setTotalTicket($totalTicket)
    {
        $this->totalTicket = $totalTicket;

        return $this;
    }

    /**
     * Get totalTicket
     *
     * @return integer
     */
    public function getTotalTicket()
    {
        return $this->totalTicket;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return InventarioTicket
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return InventarioTicket
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set idTipoEntrada
     *
     * @param \Suniland\ComunBundle\Entity\TipoEntrada $idTipoEntrada
     *
     * @return InventarioTicket
     */
    public function setIdTipoEntrada(\Suniland\ComunBundle\Entity\TipoEntrada $idTipoEntrada = null)
    {
        $this->idTipoEntrada = $idTipoEntrada;

        return $this;
    }

    /**
     * Get idTipoEntrada
     *
     * @return \Suniland\ComunBundle\Entity\TipoEntrada
     */
    public function getIdTipoEntrada()
    {
        return $this->idTipoEntrada;
    }
}

